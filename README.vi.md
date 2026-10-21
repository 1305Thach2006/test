# AI Career Coach — Cố vấn Nghề nghiệp AI Nguồn mở (Bản Tiếng Việt)

[![Giấy phép Mã nguồn: Apache-2.0](https://img.shields.io/badge/License-Apache_2.0-blue.svg)](./LICENSE)
[![Giấy phép Dữ liệu: CC BY 4.0](https://img.shields.io/badge/Data_License-CC_BY_4.0-green.svg)](./data/LICENSE)

**AI Career Coach** là ứng dụng Web mã nguồn mở được xây dựng bằng **Laravel (PHP) + Blade (HTML) + Tailwind CSS**, tích hợp **PostgreSQL 17 (`pgvector`)** và **Ollama (`qwen3:4b` + `bge-m3`)**. Hệ thống hỗ trợ sinh viên tự đánh giá năng lực qua CV so với yêu cầu tuyển dụng (JD), kiểm chứng bằng chứng nguyên văn, lập lộ trình học tập RAG theo tuần và luyện phỏng vấn kỹ thuật.

---

## 1. Cài đặt nhanh bằng một lệnh (Docker Compose)

Người chấm hoặc người dùng mới chỉ cần chạy:

```bash
cp .env.example .env && docker compose up -d
```

Sau đó mở trình duyệt tại **`http://localhost:3000`**.

Toàn bộ 5 dịch vụ trong `docker-compose.yml` sẽ tự động khởi tạo:
1. `postgres` (`pgvector/pgvector:pg17` kèm healthcheck).
2. `ollama` (máy chủ suy luận AI cục bộ).
3. `ollama-init` (tự động tải model `qwen3:4b` và `bge-m3`, thoát khi hoàn tất).
4. `web` (ứng dụng Web Laravel + Tailwind CSS tại cổng `3000`, tự động chạy migration, seed và ingest khi khởi động).
5. `worker` (tiến trình xử lý hàng đợi bất đồng bộ trên PostgreSQL).

---

## 2. Cấu hình API ngoài (Tuỳ chọn)

Mặc định hệ thống chạy hoàn toàn miễn phí với Ollama local. Nếu muốn trỏ sang bất kỳ dịch vụ tương thích chuẩn OpenAI nào khác, chỉ cần chỉnh trong `.env`:

```env
LLM_PROVIDER=openai_compatible
LLM_BASE_URL=http://ollama:11434/v1
LLM_API_KEY=ollama
LLM_MODEL=qwen3:4b
EMBED_MODEL=bge-m3
```

---

## 3. Cấu trúc Thư mục Chính

```text
├── app/
│   ├── Console/Commands/        # Lệnh app:ingest (RAG) và app:eval (Đánh giá thực nghiệm)
│   ├── Exceptions/              # Chuẩn hoá phản hồi lỗi API { error: { code, message, details? } }
│   ├── Http/Controllers/        # WebController & các Api/*Controller (/api/v1/*)
│   ├── Jobs/                    # Hàng đợi xử lý CV, JD và tính điểm Báo cáo Skill Gap
│   ├── Models/                  # 12 Eloquent Models dùng khoá chính UUID v7
│   └── Services/                # LlmProvider, PdfExtractor, SkillNormalizer 3 tầng, Scoring, RAG, Interview
├── data/                        # Dữ liệu mở (CC BY 4.0): skills.yaml, roles/*.yaml, resources/*.md, samples/, eval/
├── database/                    # Migrations (pgvector, unaccent, HNSW, GIN) & Seeders
├── docker/                      # Multi-stage Dockerfile (non-root) & entrypoint.sh
├── resources/
│   ├── prompts/                 # Các file prompt *.v1.md bọc dữ liệu trong thẻ <cv> / <jd>
│   └── views/                   # Giao diện HTML Blade + Tailwind CSS (Dark Mode, Responsive 375px+)
└── tests/                       # Unit Test & Feature Test chạy với FakeLlmProvider
```
