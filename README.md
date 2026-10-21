# AI Career Coach — Open-Source Career Advisor & Skill Gap Analyzer

[![License: Apache-2.0](https://img.shields.io/badge/License-Apache_2.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)
[![Data License: CC BY 4.0](https://img.shields.io/badge/Data_License-CC_BY_4.0-green.svg)](https://creativecommons.org/licenses/by/4.0/)
[![Stack: Laravel 11 + Tailwind CSS + Ollama](https://img.shields.io/badge/Stack-Laravel_11_%7C_Tailwind_CSS_%7C_Ollama-indigo.svg)](#)

> 🇻🇳 **Tài liệu Tiếng Việt đầy đủ:** Xem tại [README.vi.md](./README.vi.md)

**AI Career Coach** là nền tảng web mã nguồn mở giúp sinh viên Công nghệ Thông tin phân tích kỹ năng và kinh nghiệm từ CV so với yêu cầu tuyển dụng thực tế (JD), chỉ ra các kỹ năng còn thiếu (**Skill Gaps**) kèm trích dẫn nguyên văn (`evidence`), gợi ý lộ trình học tập cá nhân hoá (**Hybrid RAG**) và luyện phỏng vấn kỹ thuật thích ứng (**Adaptive Mock Interview**).

---

## 1. Tính năng cốt lõi

1. **Mọi kết luận AI đều có bằng chứng thật (`evidence`):** Mỗi kỹ năng trích xuất từ CV và mỗi yêu cầu từ JD đều đi kèm đoạn trích nguyên văn. Máy chủ kiểm tra nghiêm ngặt đoạn trích đó có thực sự xuất hiện trong văn bản gốc hay không để loại bỏ hoàn toàn ảo giác (hallucination).
2. **Chuẩn hoá kỹ năng 3 tầng (3-Tier Skill Normalizer):**
   - **Tầng 1 (Alias):** Khớp chính xác theo tên chuẩn, từ đồng nghĩa, bỏ dấu và hậu tố `.js`/`js`.
   - **Tầng 2 (Vector Similarity):** Tìm kiếm láng giềng gần nhất bằng vector embedding `bge-m3` (1024 chiều); tự động chấp nhận nếu $\text{Cosine} \ge 0.82$.
   - **Tầng 3 (LLM Disambiguation):** Khi $0.65 \le \text{Cosine} < 0.82$, đưa top-5 ứng viên gần nhất cho LLM chọn hoặc đánh dấu `unmapped`.
3. **Lộ trình học tập Hybrid Search + RRF ($k=60$):** Kết hợp tìm kiếm Vector và Full-Text Search (`tsvector` + `unaccent`), hợp nhất bằng Reciprocal Rank Fusion và tự động phân bổ các mục học tập không vượt quá quỹ giờ mỗi tuần (`hoursPerWeek`).
4. **Phỏng vấn thử thích ứng (Adaptive Mock Interview):** Mặc định 5 câu hỏi ưu tiên gap `required`, tự động tăng độ khó khi ứng viên đạt $\ge 4/5$ điểm và giảm độ khó trên cùng kỹ năng khi đạt $\le 2/5$ điểm. Chấm điểm khách quan theo Rubric (`correctness`, `depth`, `clarity`) ở nhiệt độ $0$.
5. **100% AI mở chạy cục bộ (Local-first):** Mặc định sử dụng **Ollama** (`qwen3:4b` cho suy luận/chat và `bge-m3` cho vector embedding), không yêu cầu khoá API trả phí.

---

## 2. Cài đặt nhanh bằng 1 lệnh (Quick Start — Docker)

### Yêu cầu hệ thống khuyến nghị
- **RAM:** Tối thiểu 8 GB (Khuyến nghị **16 GB RAM** để chạy mượt đồng thời PostgreSQL 17 và Ollama).
- **Ổ đĩa trống:** ~10 GB (chứa Docker images và 2 model `qwen3:4b`, `bge-m3`).
- **Hệ điều hành:** Linux, macOS, hoặc Windows (chạy qua Docker Desktop + WSL2).

### Khởi chạy ngay với 4 bước chuẩn:

```bash
git clone https://github.com/ai-career-coach/ai-career-coach.git
cd ai-career-coach
cp .env.example .env && docker compose up -d
```

Sau khi khởi chạy, mở trình duyệt tại:
- **Giao diện Web chính:** [http://localhost:3000](http://localhost:3000)
- **Tài liệu OpenAPI (Swagger UI):** [http://localhost:3000/api/docs](http://localhost:3000/api/docs)
- **Kiểm tra trạng thái hệ thống & model:** [http://localhost:3000/api/v1/health](http://localhost:3000/api/v1/health)

*(Nếu máy có GPU NVIDIA, chạy bằng: `docker compose -f docker-compose.yml -f docker-compose.gpu.yml up -d` để tự động kích hoạt GPU và dùng model `qwen3:8b`).*

---

## 3. Cài đặt từ mã nguồn (Local Development)

```bash
# 1. Cài đặt phụ thuộc PHP và Frontend
composer install
npm install && npm run build

# 2. Sao chép file cấu hình môi trường
cp .env.example .env
php artisan key:generate

# 3. Chạy migration, nạp danh mục kỹ năng & tài liệu học RAG
php artisan migrate --force
php artisan db:seed --force
php artisan app:ingest

# 4. Khởi chạy Web server và Queue Worker
php artisan serve --port=3000
php artisan queue:work
```

### Các lệnh kiểm thử & đánh giá:
- `composer test`: Chạy toàn bộ Unit Test & Feature Test với `FakeLlmProvider`.
- `composer ingest`: Nạp và tạo chỉ mục cho `data/resources/*.md`.
- `composer eval`: Chạy bộ đánh giá thực nghiệm trên `data/eval/labeled_pairs.json` và xuất báo cáo `docs/evaluation.json`.

---

## 4. Giấy phép & Kênh Cộng đồng

- **Mã nguồn phần mềm:** Cấp phép theo giấy phép mở chuẩn OSI **[Apache License 2.0](./LICENSE)**.
- **Dữ liệu mở (`data/`):** Cấp phép theo **[Creative Commons Attribution 4.0 International (CC BY 4.0)](./data/LICENSE)**.
- **Danh sách giấy phép bên thứ ba:** Xem chi tiết tại [THIRD_PARTY_LICENSES.md](./THIRD_PARTY_LICENSES.md).
- **Kênh thảo luận & hỗ trợ cộng đồng:**
  - GitHub Issues & Discussions của kho mã nguồn.
  - Hướng dẫn đóng góp: [CONTRIBUTING.md](./CONTRIBUTING.md) | Quy tắc ứng xử: [CODE_OF_CONDUCT.md](./CODE_OF_CONDUCT.md) | Bảo mật: [SECURITY.md](./SECURITY.md).
