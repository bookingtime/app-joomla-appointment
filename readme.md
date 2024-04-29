# module-joomla-appointment
Joomla extension appointment, booking module wrapper for CMS Joomla with included setup process.

<img src="https://github.com/bookingtime/module-joomla-appointment/blob/master/aws/logo_joomla.png" alt="logo joomla" width="200" />



## Requirements
- Joomla version 4+5: https://manual.joomla.org/docs/next/get-started/technical-requirements/



## Installation
1. Download the latest version of bookingtimeAppointmentComponent from [GitHub](https://github.com/bookingtime/module-joomla-appointment).
2. Extract the downloaded ZIP archive.
3. Open the Joomla Administrator Dashboard.
4. Navigate to `Extensions` > `Manage` > `Install`.
5. Choose the `Upload Package File` option.
6. Select the downloaded ZIP file of bookingtimeAppointmentComponent and click on `Upload & Install`.

## Configuration
After installing bookingtimeAppointmentComponent, you can customize the settings:

1. Open the Joomla Administrator Dashboard.
2. Navigate to `Components` > `bookingtime appointment`.
3. Create a new account or connect with your bookingpage if account already exist.
4. Adjust the settings as needed and click on `Save`.

## Usage
To use bookingtimeAppointmentComponent, follow these steps:

1. Open the Joomla Administrator Dashboard.
2. Navigate to `Content` > `Site Modules` > `MOD_APPOINTMENT`.
3. Here, you can select an appointment url.
4. Set the `status` to published.
5. Set the `Menu Assignment` to `On all Pages`

## Frontend
To show the bookingtimeAppointmentComponent in your website, follow these steps:

1. Open the Joomla Administrator Dashboard.
2. Navigate to `Content` > `Articles` and click on `+ New`.
3. Click on `CMS Content` and select `Module`.
4. Now select the created `MOD_APPOINTMENT` module.
5. In your HTMl-Editor should now be someting like this `{loadmoduleid 1}`.

### bookingtimeAppointmentComponent is not displaying correctly

If bookingtimeAppointmentComponent is not displaying correctly, you can perform the following troubleshooting steps:

1. Check if the component was installed properly.
2. Ensure all required files were uploaded.
3. Consider updating to the latest version of Joomla if necessary.

## Composer
Another way to install the extension is through Composer.
```bash
composer require bookingtime/module-joomla-appointment
```
see: https://packagist.org/packages/bookingtime/module-joomla-appointment



## Help and docs
- Support for developers: https://developer.bookingtime.com
- See the full API documentation under https://service.bookingtime.com/apidoc/module



## Security
If you discover a security vulnerability within this package, please send an email to support@bookingtime.com or create a [ticket](https://developer.bookingtime.com/hc/en-us/requests/new?ticket_form_id=9359661193628). All security vulnerabilities will be promptly addressed.



## License
This extension is distributed under the MIT License, see LICENSE file for more information.



---
Copyright 2014 bookingtime GmbH. All Rights Reserved.

Made with :blue_heart: by © bookingtime

<img src="https://github.com/bookingtime/module-joomla-appointment/blob/master/aws/logo_bookingtime.png" alt="logo" width="30" height="44" />
