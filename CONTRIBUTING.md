# Hướng dẫn Đóng góp (Contributing Guide)

Cảm ơn bạn đã quan tâm và đóng góp cho dự án nguồn mở **AI Career Coach**!

## 1. Quy trình làm việc & Quy ước nhánh

- Nhánh tính năng: `feat/<ten-tinh-nang>`
- Nhánh sửa lỗi: `fix/<ten-loi>`
- Nhánh tài liệu: `docs/<noi-dung>`
- Nhánh dữ liệu mở: `data/<noi-dung>`
- Mọi commit tuân thủ chuẩn **Conventional Commits** (ví dụ: `feat: add hybrid search RRF scoring`, `data: add cloud native skills`).

## 2. Ràng buộc kỹ thuật bắt buộc khi gửi Pull Request

1. **Giấy phép OSI:** Chỉ sử dụng các thư viện phụ thuộc có giấy phép được OSI phê duyệt (Apache-2.0, MIT, BSD-2/3-Clause, ISC, PostgreSQL).
2. **Bảo mật & Quyền riêng tư:** Không bao giờ ghi log nội dung CV của người dùng. Luôn giữ cơ chế ẩn thông tin định danh (`[EMAIL_REDACTED]`, `[PHONE_REDACTED]`).
3. **Bằng chứng xác thực (`evidence`):** Mọi kết quả trích xuất kỹ năng hoặc khoảng cách kỹ năng đều phải đi qua hàm kiểm chứng `SkillNormalizerService::verifyEvidenceInSource()`.
4. **Kiểm thử tự động:** Chạy `composer test` đảm bảo 100% bài kiểm thử vượt qua với `FakeLlmProvider` (tuyệt đối không gọi model thật trong CI).
