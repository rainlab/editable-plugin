# In-context editor plugin

This plugin allows in-context editing (click to edit) features to the [OctoberCMS](http://octobercms.com) front-end.

Only allocated content blocks found in the theme can be edited. Content blocks are edited with a WYSIWYG editor for `htm` extension and a source editor for `txt` and `md` file types. It is not suitable for editing partials and pages that have a more delicate structure.

Implementation is simply replacing the `{% content %}` tags with the component.

## Using the editable component

First you must ensure that the Editable component is attached to the page or layout. Then create a content block using the CMS.

For a content block with the file **welcome.htm**, that would be located in the **/content** directory of a theme, it can be displayed on the front end like this:

```
title = "A page"
url = "/a-page"

[editable]
==

<!-- This content will be editable -->
{% component 'editable' file="welcome.htm" %}
```

You can also pass the file property when the component is defined, which is an alternative usage suitable for a single content block.

```
title = "A page"
url = "/a-page"

[editable aboutus]
file = "welcome.htm"
==

<!-- This content will be editable -->
{% component 'aboutus' %}
```

## Replacing existing content blocks with editable content blocks.

An example content block:

    {% content "welcome.htm" %}

This block can be made editable by using the following instead:

    {% component 'editable' file="welcome.htm" %}

## Permissions

Only administrator with the permission *Manage content* are able to edit content. Administrators must also be logged in to the back-end.


## Front-end JavaScript and StyleSheet

The components in this plugin provide custom stylesheet and javascript files to function correctly on the front-end. Ensure that you have `{% scripts %}` and `{% styles %}` in your page or layout.

The styles also depend on the October JavaScript Framework, so ensure the `{% framework %}` tag is also included in your page or layout.