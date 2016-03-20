# Content plugin for CakePHP 3.x

Content is a CakePHP 3.x plugin for CMS (Content Management System) backend in Bootstrap style.
You can use this plugin individually or as an extension of [Builder](https://github.com/aoliverio/builder/).

Some of the highlights:

- Manage web contents as pages, news, images, attachments.
- Hierarchical content management.
- Additional information about the content using meta information.
- Organize the contents by categories.
- Add taxonomy for all content.
- File management in uploads directory.

## Minimal Requirements

The Content plugin using this third-party libraries, managed with aoliverio/builder plugin:

- jQuery
- jQuery UI
- Bootstrap
- FontAwesome
- DataTables (Add advanced interaction controls to any HTML table, http://datatables.net)
- Summernote (Simple WYSIWYG editor on Bootstrap, http://summernote.org)

And additional library managed with internal bower_components:

- DatePicker (view on GitHub https://eonasdan.github.io/bootstrap-datetimepicker/)

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:
```
composer require aoliverio/content
```

Load plugin in your application:
```
bin/cake plugin load Content
```

## Docs

For more informations about installation and configuration options, see the [WIKI](https://github.com/aoliverio/content/wiki).

## Bugs & Feedback

[https://github.com/aoliverio/content/issues](https://github.com/aoliverio/content/issues).

## License

Copyright (c) 2015 Antonio Oliverio and licensed under [MIT License](http://opensource.org/licenses/mit-license.php).
