# File Uploading Application Using Laravel
FUA 0.0.1
================

It is basic Application where user and admin can login, User can upload material and files, where admin manage users and material and files.


### Download instructions:
--------
1. Clone the project.

```
git clone https://github.com/bhatt-animesh/File_Uploading_Application.git
```

2. Install dependencies via composer.

```
composer install 
```
3. Install javascript modules via npm. 

```
npm install
```
4. Import DB.

```
Present In DB_Schema Folder
```
5. Change In .evn File For Database connectivity.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=filedb
DB_USERNAME=root
DB_PASSWORD=
```
6. Dummy Credentials For Login. 

```
| Account Type  | CompanyID | Password |
| ------------- | -------- |  -------- |
| Admin         | 852963   | 87654321  |
| User          | 741852   | 12345678  |

```
7. Run php Development server.

```
php artisan serve
```
8. Go To browser Type.

```
http://127.0.0.1:8000

```

#### **FUNCTIONS OF ACCOUNTS** 

**-- ADMIN**
- Only Admin can delete any record
- Create Other Admin account
- Block Any User
- Delete Any User
 
**-- USER**
- Only Add material and files
- can delete,edit and update files

### **Contributing**

Your Contributions & suggestions are welcomed.
