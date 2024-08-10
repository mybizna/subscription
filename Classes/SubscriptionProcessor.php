<?php

namespace Modules\Subscription\Classes;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Modules\Affiliate\Classes\UpgradeAccount;
use Modules\Affiliate\Models\Affiliate;
use Modules\Affiliate\Models\Package as SubPackage;
use Modules\Core\Classes\Common;
use Modules\Core\Models\Source;
use Modules\Subscription\Models\Subscription;

class SubscriptionProcessor
{
    public function autoExtend()
    {
        $test = 1;
    }

    public function updateRecord($subscription, $payment, $affiliate)
    {
        $subscription = $this->updateSubscription($subscription);
        $affiliate = $this->updateAffiliate($subscription, $payment, $affiliate);

        return $affiliate;
    }

    public function updateSubscription($subscription)
    {
        $expiry_date = $this->getExpiryDate($subscription->expiry_date, $subscription->package->no_of_days);

        $subscription->status = true;
        $subscription->paid = true;
        $subscription->completed = true;
        $subscription->is_new = false;
        $subscription->expiry_date = $expiry_date;
        $subscription->last_upgrade_date = Carbon::now();

        if (!$subscription->upgrade_date) {
            $subscription->upgrade_date = Carbon::now();
        }

        if ($subscription->is_new) {
            $subscription->upgrade_date = Carbon::now();
        }

        $subscription->save();

        return $subscription;
    }

    public function updateAffiliate($subscription, $payment, $affiliate)
    {
        $upgrade_account = new UpgradeAccount();
        $common = new Common();

        $package_tracked = Config::get('affiliate.payment_source_tracked');
        $pro_package = Config::get('subscription.pro_package');

        list($app_name, $model_name) = explode(':', $package_tracked);

        if ($app_name == 'subscription' && $model_name == 'Subscription') {
            if (!$affiliate) {
                $affiliate = Affiliate::where('partner_id', $payment->partner_id)->first();
            }

            $source = Source::where('app_name', $app_name)->where('model_name', $model_name)->first();
            $package = $this->getDefaultPackage($subscription->package_id);

            $affiliate->package_id = $package->id;
            $affiliate->source_ident = $subscription->id;
            $affiliate->source_id = $source->id;
            $affiliate->status = $subscription->status;
            $affiliate->paid = $subscription->paid;
            $affiliate->completed = $subscription->completed;
            $affiliate->is_new = $subscription->is_new;
            $affiliate->placement = true;
            $affiliate->expiry_date = $subscription->expiry_date;
            $affiliate->upgrade_date = $subscription->upgrade_date;
            $affiliate->last_upgrade_date = $subscription->last_upgrade_date;
            $affiliate->is_pro = intval($pro_package) === intval($subscription->package_id);
            $affiliate->save();

            $upgrade_account->upgradeAccount($affiliate);
        }

        return $affiliate;
    }

    public function getExpiryDate($expiry_date, $no_of_days = 30)
    {
        $no_of_days = $no_of_days ?: 30;
        $d = Carbon::now()->addDays($no_of_days);

        if (is_null($expiry_date)) {
            $expiry_date = $d;
        } else {
            $expiry_date = Carbon::parse($expiry_date);
            $expiry_date_stamp = $expiry_date;
            $today_date_stamp = Carbon::now();

            if ($expiry_date_stamp > $today_date_stamp) {
                $expiry_date = $expiry_date->addDays($no_of_days);
            } else {
                $expiry_date = $d;
            }
        }

        return $expiry_date;
    }

    public function getDefaultPackage($source_ident = '')
    {
        if ($source_ident) {
            $package = SubPackage::where('source_ident', $source_ident)->first();
            $package = $package ?: SubPackage::where('paid_default', 1)->first();
        } else {
            $package = SubPackage::where('paid_default', 1)->first();
        }

        return $package ?: SubPackage::first();
    }

    public function getSubscriptionDefaultPackage($source_ident = '')
    {
        if ($source_ident) {
            $package = SubPackage::where('source_ident', $source_ident)->first();
            $package = $package ?: SubPackage::where('paid_default', 1)->first();
        } else {
            $package = SubPackage::where('amount', '>=', 0)->first();
        }

        return $package ?: SubPackage::first();
    }

    // Rest of the class methods...

    public function syncSubscriptionNHosting()
    {
        $hostings = DB::select('SELECT hosting_hosting.* FROM hosting_hosting
                                    LEFT JOIN subscription_subscription ON hosting_hosting.partner_id = subscription_subscription.partner_id
                                    WHERE hosting_hosting.status <> subscription_subscription.status
                                    AND hosting_hosting.status = 1
                                    AND hosting_hosting.expiry_date > NOW()');

        $package = $this->getSubscriptionDefaultPackage();

        foreach ($hostings as $hosting) {
            $subscription = Subscription::where('partner_id', $hosting->partner_id)->first();

            if (!$subscription->status && is_null($subscription->expiry_date)) {
                $subscription->package_id = $package->id;
                $subscription->save();

                $this->updateSubscription($subscription);
            }
        }
    }

    public function syncExpiryPaidStatus()
    {
        $active_subscription_list = $this->getActiveToSync();

        foreach ($active_subscription_list as $subscription) {
            $subscription->paid = true;
            $subscription->status = true;
            $subscription->completed = true;
            $subscription->successful = true;
            $subscription->save();
        }

        $inactive_subscription_list = $this->getInActiveToSync();

        foreach ($inactive_subscription_list as $subscription) {
            $subscription->paid = false;
            $subscription->status = false;
            $subscription->completed = false;
            $subscription->successful = false;
            $subscription->save();
        }
    }

    public function getActiveToSync()
    {
        return Subscription::where('paid', false)
            ->where('expiry_date', '>', Carbon::today())
            ->limit(100)
            ->get();
    }

    public function getInActiveToSync()
    {
        return Subscription::where('paid', true)
            ->where('expiry_date', '<', Carbon::today())
            ->limit(100)
            ->get();
    }

}
