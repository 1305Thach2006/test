# Changelog

Mọi thay đổi đáng chú ý của dự án **AI Career Coach** đều được ghi nhận tại tệp này theo chuẩn [Keep a Changelog](https://keepachangelog.com/en/1.1.0/) và [Semantic Versioning](https://semver.org/).

## [0.1.0] - 2026-10-20

### Added
- Khởi tạo ứng dụng Web mã nguồn mở **AI Career Coach** trên nền tảng **Laravel 11 (PHP) + Blade (HTML) + Tailwind CSS**.
- Tích hợp cơ sở dữ liệu **PostgreSQL 17 (`pgvector`, `unaccent`, `pgcrypto`)** với 12 bảng chuẩn khoá chính UUID v7 và xoá cascade.
- Xây dựng lớp trừu tượng `LlmProviderInterface` với `OpenAiCompatibleProvider` (tích hợp **Ollama** `qwen3:4b` & `bge-m3`) và `FakeLlmProvider` phục vụ kiểm thử tự động.
- Triển khai pipeline phân tích **Skill Gap**: trích xuất PDF bằng `smalot/pdfparser`, ẩn thông tin cá nhân (Email/SĐT), kiểm chứng đoạn trích nguyên văn (`evidence`), chuẩn hoá kỹ năng 3 tầng (Alias -> Vector Cosine $\ge 0.82$ -> LLM Top-5) và hàm tính điểm thuần `ScoringService`.
- Triển khai hệ thống **Hybrid RAG (`php artisan app:ingest`)** kết hợp Vector Search + Full-Text Search với Reciprocal Rank Fusion ($k=60$) và tự động phân bổ giờ học mỗi tuần (`hoursPerWeek`).
- Triển khai mô-đun **Phỏng vấn thử thích ứng (Adaptive Mock Interview)** tự động điều chỉnh độ khó theo điểm câu trước và chấm điểm theo Rubric ở nhiệt độ $0$.
- Hoàn thiện giao diện Web hỗ trợ Tiếng Việt / Tiếng Anh, chế độ Sáng / Tối (Dark Mode), biểu đồ Radar (Chart.js), Popover xem trích dẫn và Banner trạng thái tải model AI.
