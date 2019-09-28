# sc-utility
Simply Computing utility plugin for ClassicPress sites

https://simplycomputing.com.au

mail@simplycomputing.com.au

Written by Alan Coggins

21 August 2019

Version 1.0.10


This is a small plugin designed to be used on websites managed by Simply Computing.

Important Note: The plugin becomes locked to the user who initially activates it. Once locked to one admin user, no other user will see the link in the side menu. To avoid any other user resetting this, it is advisable to use the utility to hide the 'Plugins' link after activation.

The utility panel has five sections for settings:

1. Dashboard widget information

These fields are used to add a dashboard widget that gives the client the support details for contacting the website developers. The final checkbox is used to enable the widget.

2. Simplify admin area side menu

These checkboxes can be used to hide unnecessary items on the admin side menu. 

3. Add individual menu items from the submenus

These two checkboxes can be used to give clients access to the 'Widgets' and 'Menus' pages in case 'Appearance' has been disabled.

4. Simplify pages and posts

These checkboxes remove meta panels from the pages and posts areas.

5. Simplify other areas

A few more options to hide unnecessary widgets on the main dashboard, and menu items in the top admin bar.


Changelog:

------------

Version 1.0.10 (28/09/2019)

Change security option to include new ClassicPress security menu item
Remove hiding of email log
Add php version and plugin list to the "At a Glance" dasboard widget

------------

Version 1.0.9

Add dashboard widget to show last 10 saved contact messages
Rearrange structur on main screen
Combine hiding email log with Shield setting.

------------

Version 1.0.8

Add checkbox to enable custom post type for contact messages.
Remove checkbox for hiding links from admin menu.

------------

Version 1.0.7

Add checkbox to hide featured image box.

------------

Version 1.0.6

Add feature to specify the number of page and post revisions to be saved.

------------

Version 1.0.5

Fix function to remove meta box in GeneratePress theme.

------------

Version 1.0.4

Fixed issue with hiding slug meta box at bottom of page. The hide slug option now hides both this box and the permalink setting area at the top of the page or post.

------------

Version 1.0.3

Added checkbox to hide Shield Security menu item.

------------

Version 1.0.2

Added in uninstall.php file to clean up database.

------------

Version 1.0.1 

Changed the security method to lock usage to the admin user who activates the plugin.

Changed function names to make them unique and avoid conflicts.

Added updater file.

------------

Version 1.0.0 

Initial release.
