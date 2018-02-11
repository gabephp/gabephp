# GabePHP  
An MVC framework written in PHP 7.2.

### Introduction  
I started this framework as a learning project to find out how MVC frameworks are built from the ground up, 
as well as an attempt to replicate a few of the features I liked in other frameworks and implement them into mine.  
I used to be very fond of using [CodeIgniter](https://codeigniter.com/) at first, but after a while I felt like
this wasn't the framework for be, mostly because as a personal preference I am horny for using namespaces in PHP, 
which CodeIgniter doesn't for backwards compatibility reasons.

This framework is intended to be a framework with a light footprint and a capability of fast response times.
On top of the built in improvements that PHP 7.2 gives us, using [Twig](https://twig.symfony.com/) as a templating engine and 
[Doctrine](http://www.doctrine-project.org/) as an ORM has proven to work incredibly fast because of the libraries' caching capabilities.

Another reason for GabePHP's light footprint is the ClassFactory I implemented. 
The class factory is responsible for making sure only one instance of each class exists per request 
(exceptions being the entities used by doctrine, for example). 
Another one of it's responsibilities is injecting said class instances into function, 
using reflection to find out what the hinted parameter types of the function in question are
(another reason I decided to build this framework on top of PHP 7.2).