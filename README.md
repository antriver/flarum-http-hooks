A [Flarum](http://flarum.org/) extension that makes POST requests to URLs you specify when certain events happen.

### Supported Events
Only the following events are currently supported. Feel free to make a pull request to add more.
* PostWasPosted

# Installation
```
composer require antriver/flarum-http-hooks
```

# Configuration
There is no UI for specifying the URLs. Instead you must add an entry to your database containing a JSON string.
 
Example configuration:
```json
{"PostWasPosted":["http://www.example.com/someplace", "https://www.example.org/otherplace"]}
```

Makes those 2 URLs receive a POST request when Flarum's PostWasPosted event fires.

To add this to you settings table:
```sql
INSERT INTO `settings` (`key`, `value`)
VALUES
	('flarum-http-hooks.urls', '{\"PostWasPosted\":[\"http://www.example.com/someplace\", \"https://www.example.org/otherplace\"]}');
```
