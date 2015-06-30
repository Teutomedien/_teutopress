[![Build Status](https://travis-ci.org/Automattic/_s.svg?branch=master)](https://travis-ci.org/Automattic/_s)

_teutopress
===
# teutopress
a blank theme to start development based on _s.
The Blog specific elements are removed and/or disabled (i.e. not Jetpack) to work as a CMS Theme. Also there are some neat function added. 

1. Native ACF Pro Support. (You need to copy your ACF Files to /acf Pro or free Version is fine)
2. Added spambot function for all content, widgets and acf fields
3. Disabled Comments (can be activated in inc/extras.php)
4. Removed the WP-Customizer Setting
5. Removed the WP-Custom Header Settingep find and replace on the name in all the templates.

#Getting started

1. Search for `'_teutopress'` (inside single quotations) to capture the text domain.
2. Search for `_teutopress_` to capture all the function names.
3. Search for `Text Domain: _teutopress` in style.css.
4. Search for <code>&nbsp;_teutopress</code> (with a space before it) to capture DocBlocks.
5. Search for `_teutopress-` to capture prefixed handles.

OR

* Search for: `'_teutopress'` and replace with: `'megatherium'`
* Search for: `_teutopress_` and replace with: `megatherium_`
* Search for: `Text Domain: _teutopress` and replace with: `Text Domain: megatherium` in style.css.
* Search for: <code>&nbsp;_teutopress</code> and replace with: <code>&nbsp;Megatherium</code>
* Search for: `_teutopress-` and replace with: `megatherium-`

Then, update the stylesheet header in `style.css` and the links in `footer.php` with your own information. Next, update or delete this readme.

#SASS and CSS
You can use SASS or hack the CSS File. I recommend SASS and  compile with [Codekit](https://incident57.com/codekit/) Tool or via CLI.

#TODO

Bootstrap Version