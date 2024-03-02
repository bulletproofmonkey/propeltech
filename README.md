## Address Book

### Installation
To run this on your machine you will need to ensure all required packages are installed

```
composer install
```

### Running
Then use *artisan* to serve the content
```
php artisan serve
```

Then visit http://localhost:8000/ to view the Address Book.

### Notes
1. Out of the box it uses the example data, but this can be viewed, edited, created or deleted.
2. The pages show a link under the header to change the type of mechanisms used, by default it uses traditional form submissions (step 1 in the instructions), and clicking the link *Single Page Application (via API)* will change it to behave as an SPA, using jQuery and the API (step 2 in the instructions). The SPA uses modals for the forms, delete confirmation and view "window".
3. Its uses stock Laravel, I've deleted some unnecessary bits but left it mostly as is.
4. Test coverage is provided.
