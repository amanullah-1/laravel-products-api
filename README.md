# Laravel Products API

This is a RESTful API for managing products, built with Laravel. The API provides full CRUD (Create, Read, Update, Delete) functionality for products with additional features like search and pagination.

## Features

- **Product Management**: Create, read, update, and delete products
- **Search Functionality**: Filter products by title
- **Pagination**: Built-in pagination for product listings
- **Validation**: Comprehensive request validation
- **CORS Support**: Ready for cross-origin requests

## API Endpoints

| Method | Endpoint          | Description                          |
|--------|-------------------|--------------------------------------|
| GET    | /api/products     | List all products (paginated)        |
| POST   | /api/products     | Create a new product                 |
| GET    | /api/products/{id}| Get a single product                 |
| PUT    | /api/products/{id}| Update a product                     |
| DELETE | /api/products/{id}| Delete a product                     |

### Query Parameters

- `search`: Filter products by title (GET /api/products)
- `per_page`: Items per page (default: 10, GET /api/products)

## Requirements

- PHP 8.0 or higher
- Laravel 9.x or higher
- MySQL 5.7+ or MariaDB 10.2+
- Composer

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo/laravel-products-api.git
   cd laravel-products-api
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Create and configure the `.env` file:
   ```bash
   cp .env.example .env
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Configure your database settings in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel_products
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Run migrations:
   ```bash
   php artisan migrate
   ```

7. (Optional) Seed the database with sample data:
   ```bash
   php artisan db:seed
   ```

## Running the Application

Start the development server:
```bash
php artisan serve
```

The API will be available at `http://localhost:8000/api/products`

## Testing

You can test the API using the included Postman collection or with PHPUnit:

```bash
php artisan test
```

### Postman Collection

Import the [Postman collection](#) (link to your Postman collection) to test all endpoints.

## Request/Response Examples

### Create a Product (POST /api/products)

**Request:**
```json
{
    "title": "Sample Product",
    "description": "This is a sample product",
    "price": 99.99,
    "thumbnail": "https://example.com/product.jpg"
}
```

**Success Response (201 Created):**
```json
{
    "id": 1,
    "title": "Sample Product",
    "description": "This is a sample product",
    "price": 99.99,
    "thumbnail": "https://example.com/product.jpg",
    "created_at": "2023-05-15T12:00:00.000000Z",
    "updated_at": "2023-05-15T12:00:00.000000Z"
}
```

### List Products (GET /api/products)

**Success Response (200 OK):**
```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "title": "Sample Product",
            "description": "This is a sample product",
            "price": 99.99,
            "thumbnail": "https://example.com/product.jpg",
            "created_at": "2023-05-15T12:00:00.000000Z",
            "updated_at": "2023-05-15T12:00:00.000000Z"
        }
    ],
    "first_page_url": "http://localhost:8000/api/products?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/products?page=1",
    "links": [...],
    "next_page_url": null,
    "path": "http://localhost:8000/api/products",
    "per_page": 10,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}
```

## Error Responses

### Validation Error (422 Unprocessable Entity)
```json
{
    "message": "Validation errors",
    "errors": {
        "title": ["The title field is required."],
        "price": ["The price must be at least 0."]
    }
}
```

### Not Found (404 Not Found)
```json
{
    "message": "No query results for model [App\\Models\\Product] 1"
}
```

## License

This project is open-source and available under the [MIT License](LICENSE).
