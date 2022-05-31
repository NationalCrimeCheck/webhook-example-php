# NCC Webhook Example For PHP

This is a small example for a webhook server written using ReactPHP. This sample
simply outputs the events directly on-screen, but it would be easy to adapt this
sample to instead push the events to a database or file, push them into a queue
for processing, or to undertake some action directly.


## Running this sample

Firstly, execute `composer install` to install the dependencies.

You can run the sample from the command line with `php app.php`.


## Testing the sample

With the sample running, execute `php test/test.php` to send a test event to the
sample. These test events have random Person IDs, random event GUIDs, and a random
event type.
