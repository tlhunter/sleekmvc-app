SleekMVC: A Simple PHP MVC Framework
===

When I started developing PHP, I slowly evolved my own PHP framework. It became a horrible mess of
includes and function calls. The one thing it had going for it was ease of use, compatibility with
all major servers, and most importantly, it was extremely easy to use (even by developers who had
a few weeks of PHP experience). I spruced up that framework and released it as AcdBrn.

Years later, I began using a framework called CodeIgniter. It was amazing, it provided so much
functionality and was super easy to use. Months later I became more proficient in class based PHP
development and could tell something was wrong. It was time to move on to another framework.

After that I switched to Kohana and things were awesome again. It provided tons of functionality,
used 'proper' PHP class methodologies (CI seemed to load everything as a singleton, required that
you call a class by passing a string to a function, and had no autoloading). But, while I was able
to use Kohana with ease, it was obvious that this framework is not friendly to beginners.

That is what SleekMVC aims to do. I want this framework to stay so simple that any developer
(including beginners) can look through the code and understand everything. Kohana would take weeks
for an intermediate to advanced developer to grok the framework; SleekMVC should take a Beginner
a red-bull fueled weekend evening.

Goals for SleekMVC:
==
* So easy to use, first year PHP developers can become proficient
* Stable enough to be used for production websites
* Secure variables and prevent XSS and injection attacks
* Core framework should remain small and lightweight, no 'magic' (Cake is fat)
* Don't clobber $_GET (or any super global) variables (CodeIgniter, I'm looking at you)
* Don't require a ton of 'empty' class files (Kohana, that's you)
* Provide a easily understood autoloader (no surprises or confusion for naming)
* Use 'standard' PHP class conventions (no CI $this->load->model('classnameasastring') stuff)
* Use raw PHP files for views (but allow template engine usage if desired)
* View files won't need to execute classes to access data
* Work "Out of the Box" with standard IDE "intellisense" features
* Provide extensive, clear documentation (As good as CodeIgniter, waay better than Kohana)
* Maintain backwards compatability (Another ding for Kohana)
