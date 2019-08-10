# =====INTERVIEW QUESTIONS======

# =====JAVASCRIPT QUESTIONS======
# Difference between library and framework?
# library - Jquery, React
# Framework - Angular, Bootstrap, Vuejs
# Vuejs (0.9)
  progressive framework used for single page applications, Single page applications. components, lightweigth and high performance. speed equal to angular & react.
  compare to angular is very easy. easy to learn. used for lightweigth projects.
# React
frontend library. faster than angular but not vuejs. Server-Side Rendering (SSR). Created by facebook.DOM API. Facebook used. used mobile too.
# Angular 
structural framework. front end MVC. used for Long size project. Dying because of angluar offers rendering. Hard to learn. Gmail used. single page application.
# Node.js 
used for backend and frontend. platform built on Chrome's JavaScript building fast and scalable network applications. lightweight and efficient.
# TypeScript 
Microsoft developed. strict. object oriented programming language.

# ====PHP QUESTIONS=====
# Cache
is used to make the loading of web pages faster.
# Cookie 
cookie is used to store information in visitor's browser. set time() expired if not set expired when browser close.
# 2 types of cookies: 
(1) Session Based which expire at the end of the session.
(2) Persistent cookies which are written on harddisk. stored permanently on the browser. Session cookies expire at the end of the session. This means, when you close your browser window, the session cookie is deleted.
# Session 
is used to store information to be used across multiple pages on the client as well as server. secure store.
# Abstract Class
# Multiple and Multi level inheritance. Which one php not support why?
# php redirect 
< ?php header("Location: http://www.redirect.to.url.com/"); ?>
# difference b/w include vs require vs include_once vs require_once?
# GET - Send data in url.
# POST - secure transfer data.
# PHP does not support multiple inheritance
# difference b/w delete and truncate and drop?
truncate - delete all rows in a table. can't used with index. faster. DDL. remove allocated spaces too.
delete - delete rows with where condition. can used with index. can be rolled back. DML.
drop - remove table from db. DDL.
# diff b/w between explode and split
 split - uses pattern to split strings into array.
 explode - use string to split

# =========sql================
# DDL(Data Definition Language) 
  create and modify the structure of database
  create , drop, truncate, alter, command , rename
# DML(Data Manipulation Language)
  select , insert, update, delete
# DCL(Data Control Language)
  deal with permissions
  GRANT , REVOKE
# TCL(transaction Control Language) 
  TCL commands deals with the transaction within the database.
  commit, rollback, savepoint, set transaction
# sql storage engine types
  innodb - faster for write,transaction, row locking,
  MyISAM - faster for read,
#  pivot
 convert row data to column
# unpivot
  convert column data to row

# =======oops===============
# Abstract:
  abstract method is a method that is declared, but contains no implementation, subclasses to provide implementations.abstract method can not contain body. cannot private.
  abstract class cannot be instantiate. return fatal error if instantiate.
  Abstract class can have abstract and non-abstract methods, but it must contain at least one abstract method. If a class has at least one abstract method, then the class must be declared abstract.
  When extending from an abstract class, all methods marked abstract in the parent's class declaration must be defined by the child.
  If method in parent class as protected in child class must be protected or public, also public - must public.
  You can add more optional arguments to child class. but when defined arguments in parent class it must required in child class.
  Abstract class can extends another abstract class,Abstract class can provide the implementation of interface.But it doesn't support multiple inheritance.
