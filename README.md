## About CHEN Bbs

Website: <a href="https://bbs.chen-ray.cn"> https://bbs.chen-ray.cn </a>

This project is a RESTful BBS backend. Built with Laravel 10. Observer, Policy, Notification, Quere, scheduling and other functions are used.


This project has the following features:

* Rights management: Users are divided into: "Webmaster", "Content Manager", "Registered User", and "Visitor". They each have different permissions.
* Image CDN: All images and attachments use Tencent Cloud’s CDN service to speed up access. 
* Task queue: Recommended links, active users and other functions all use the queue function.
  Multi-language: English is returned by default, and all interfaces return a code to facilitate the front-end production of multi-language functions.
