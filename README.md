# ComTrans Comment Translation (Proof of Concept)

This is an experimental module.

At its heart it defines a route /comtrans/comment/{comment-id}. This route calls
a controller to load a comment and then send the comment's text values to some
translation API and return the results as JSON. This JSON then can easily be
injected in the existing markup to display a translated comment.

1. Enable the module.
2. `$ composer install` inside the module folder or use https://github.com/wikimedia/composer-merge-plugin

@todo
I currently stopped inside the controller while figuring out how to get a
Google Translate API key.

```
Google\Cloud\Core\Exception\ServiceException: {
  "error": {
    "code": 403,
    "message": "The request is missing a valid API key.",
    "errors": [ {
      "message": "The request is missing a valid API key.",
      "domain": "global",
      "reason": "forbidden" } ],
    "status": "PERMISSION_DENIED"
  }
} in Google\Cloud\Core\RequestWrapper->convertToGoogleException() (line 263 of /Users/leymannx/Sites/d8/vendor/google/cloud-core/src/RequestWrapper.php).
```
