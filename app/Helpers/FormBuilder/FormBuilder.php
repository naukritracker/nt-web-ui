<?php

namespace App\Helpers\FormBuilder;

use App\Helpers\Contracts\FormBuilderContract;

class FormBuilder implements FormBuilderContract
{
    /**
     * [build description]
     * @param  string $route [description]
     * @return [type]        [description]
     */
    public function build($route = '', array $options = [])
    {
        $form = '';
        if ($route != '') {
            if ($route == 'SearchForJobs'
                or $route == 'AvailableLocationsListing'
                or $route == 'AvailableIndustryListing'
                or $route == 'AvailableCompaniesListing'
            ) {
                $searchForm = new SearchFormBuilder();
                if ($route == 'SearchForJobs') {
                    $form = $searchForm->buildHomeSearchForm();
                }
                if ($route == 'AvailableLocationsListing') {
                    $form = $searchForm->buildAvailableLocationsListing();
                }
                if ($route == 'AvailableIndustryListing') {
                    $form = $searchForm->buildAvailableIndustryListing();
                }
                if ($route == 'AvailableCompaniesListing') {
                    $form = $searchForm->buildAvailableCompaniesListing();
                }
            }
            if ($route == 'SaveProfile'
                or $route == 'SaveEducationDetails'
                or $route == 'SaveChangePassword'
                or $route == 'EmployerProfile'
            ) {
                $profileForm = new ProfileFormBuilder();
                if ($route == 'SaveProfile') {
                    $form = $profileForm->buildProfileResumeEditor();
                }
                if ($route == 'SaveEducationDetails') {
                    $form = $profileForm->buildProfileEducationDetails();
                }
                if ($route == 'SaveChangePassword') {
                    $form = $profileForm->buildChangePasswordForm();
                }
                if ($route == 'EmployerProfile') {
                    $form = $profileForm->buildEmployerProfile();
                }
            }
            if ($route == 'RegisterClient'
                or $route == 'RegisterEmployer'
            ) {
                if ($route == 'RegisterClient') {
                    $registerForm = new RegisterFormBuilder();
                    $form = $registerForm->buildRegisterClientForm();
                }
                if ($route == 'RegisterEmployer') {
                    $registerForm = new RegisterFormBuilder();
                    $form = $registerForm->buildRegisterEmployerForm();
                }
            }
            if ($route == 'EmployerPostAJob') {
                if ($route == 'EmployerPostAJob') {
                    $jobForm = new JobFormBuilder();
                    $form = $jobForm->buildEmployerPostAJob($options['id'], $options['type']);
                }
            }
        }
        return $form;
    }
}
