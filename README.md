PHP Simple To-Do List
**Một ứng dụng quản lý công việc đơn giản cho phép người sử dụng thao tác thêm, sửa, xóa, cập nhật các công việc cần làm với giao diện đơn giản, dễ sử dụng

---------------------------------------------------
#Môn học: Ngôn ngữ lập trình PHP  
#Công cụ: XAMPP, phpMyAdmin, PHP thuần, Bootstrap  
---------------------------------------------------

### 1. Cơ sở dữ liệu (Database Structure)

**DATABASE: todo_db**
- Bảng `users`:
	id (PK, AUTO_INCREMENT)
    username (UNIQUE)
    password (HASHED bằng password_hash())
    email (UNIQUE, có thể NULL)
	created_at (DATETIME, mặc định CURRENT_TIMESTAMP)

- Bảng `tasks`:
	id (PK, AUTO_INCREMENT)
	user_id (FK → users.id, ON DELETE CASCADE)
	title (NOT NULL)
	description (TEXT, có thể NULL)
	due_date (DATE, có thể NULL)
	status (ENUM: pending, in_progress, completed)
	created_at (DATETIME, mặc định CURRENT_TIMESTAMP)

---------------------------------------------------

# 2. Tính năng Xác thực (Authentication)

**Chức năng**
Đăng ký          | auth/register.php
Đăng nhập        | auth/login.php 
Đăng xuất        | auth/logout.php
Kiểm tra truy cập| tasks/auth_check.php

---------------------------------------------------

# 3. Quản lý công việc (CRUD) 

**Thao tác** 
Create | tasks/create.php  | Thêm công việc mới 
Read   | tasks/index.php   | Hiển thị danh sách + Lọc theo trạng thái + Sắp xếp theo hạn/mới nhất 
Update | tasks/edit.php    | Sửa + Thay đổi trạng thái 
Delete | tasks/delete.php  | Xóa công việc   

=> Tất cả công việc chỉ hiển thị của người dùng đang đăng nhập.

---------------------------------------------------

# 4. Cài đặt và chạy ứng dụng

**Yêu cầu**
	- XAMPP
	- Trình duyệt web

**Các bước**
	1. Khởi động XAMPP -> Start Apache + MySQL
	2. Mở phpMyAdmin (http://localhost/phpmyadmin), tạo một database mới tên `todo_db`
	3. Nhập tệp dữ liệu được cung cấp để thiết lập bảng (todo-db.txt)
	4. Sao chép toàn bộ thư mục todo-app vào: C:\xampp\htdocs\
	5. Mở trình duyệt web và điều hướng tới http://localhost/todo-app


	
