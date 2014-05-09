# In-context editor plugin

This plugin allows in-context editing (click to edit) features to the [OctoberCMS](http://octobercms.com) front-end.

## Editing theme content files

The file **about-us.htm** would be located in the **/content** directory of a theme.

```
title = "A page"
url = "/a-page"

[editable]
==

<!-- This content will be editable -->
{% component 'editable' file="about-us.htm" %}
```

Alternative usage:

```
title = "A page"
url = "/a-page"

[editable aboutus]
file = "about-us.htm"
==

<!-- This content will be editable -->
{% component 'aboutus' %}
```