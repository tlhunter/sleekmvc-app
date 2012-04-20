SleekMVC: A Simple PHP MVC Framework
===
SleekMVC is first and foremost a simple framework, meant to be easily consumed by the most novice of
PHP developers. It was specifically built to be used by first year PHP students while being flexible
enough to work for large scale applications. You won't find any useless classes shipped with Sleek.

[SleekMVC Documentation](https://github.com/tlhunter/sleekmvc-app/wiki)

SleekMVC requires namespaces and therefore requires PHP 5.3+. Sleek has a similar syntax to the two
well known PHP frameworks Kohana and CodeIgniter. The views are very similar, it uses convenient
autoloading like with Kohana, and doesn't require the hacky class loading of CodeIgniter left over
from it's PHP 4 compatible days.

SleekMVC is currently in beta stages and is highly recommended not to be used for productions sites.
When it is ready for public consumption, there will be documentation explaining every facet of the
framework, and detailing all of the provided classes.

Goals for SleekMVC:
==
* So easy to use, first year PHP developers can become proficient
* Secure variables and prevent XSS and injection attacks
* Core framework remain small and lightweight
* Don't clobber $_GET (or any super global) variables (e.g. CodeIgniter)
* Don't require a ton of 'empty' class files (e.g. Kohana)
* Provide a easily understood autoloader which handles namespaces
* Work with IDE autocomplete features out of the box
* Use raw PHP files for views (but allow template engine usage if desired)
* View files won't need to execute classes to access data
* Provide extensive, clear documentation, for every single developer exposed feature
* Provide request and response objects for handling related superglobals
