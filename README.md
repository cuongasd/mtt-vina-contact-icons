# MTT VINA Contact Icons 1.4.1

Bản 1.2.0 thêm nút Google Maps tròn 52px phía trên Zalo, mở https://maps.app.goo.gl/DEL3w4oQjD171L8f9 trong tab mới. Giữ nguyên vị trí cụm liên hệ, màu và liên kết của hai nút cũ. Chỉ thêm bản đồ khi có cụm liên hệ phù hợp; không tạo nút trùng.

Cài đặt: Plugin → Cài mới → Tải plugin lên → chọn mtt-vina-contact-icons-1.0.0.zip → Cài đặt → Kích hoạt.

Plugin đổi hai nút liên hệ hiện có thành icon tròn 52px, giữ màu, vị trí và đường dẫn gốc. Không thêm nút nếu website không có cấu trúc phù hợp. Bản 1.3.1 đã gỡ chế độ test cover GIF và trang cấu hình của nó.

Hoàn tác: Vô hiệu hóa plugin, làm mới cache website nếu có và tải lại trang.

Cập nhật: tải ZIP phiên bản mới qua cùng giao diện, chọn thay thế phiên bản cũ khi WordPress yêu cầu.

Kiểm tra sau cài: xem trang chủ và trang tin tức trên máy tính/điện thoại; đối chiếu link Zalo và tel; kiểm tra phím Tab và nhãn nút. Không cần thực hiện cuộc gọi.

## Cập nhật từ GitHub
Repo: https://github.com/cuongasd/mtt-vina-contact-icons
Phiên bản tích hợp updater: 1.1.0. Thư viện PUC 5.7 được ghim trong DEPENDENCIES.md.
Cài ZIP 1.1.0 thay thế plugin cũ một lần, rồi bật tự cập nhật riêng MTT VINA Contact Icons.
WordPress cần quyền ghi plugin, HTTPS ra GitHub và tác vụ định kỳ hoạt động. Không cần token cho repo công khai.
Chỉ nhận stable Release có file mtt-vina-contact-icons-X.Y.Z.zip; không lấy branch/tag dự phòng.
Kiểm tra mặc định khoảng 12 giờ; tự cài còn phụ thuộc lịch WordPress. Không đồng bộ tức thì khi lưu file.

## Phát hành
Tăng phiên bản ở header PHP, hằng MTT_VINA_CONTACT_ICONS_VERSION và Stable tag trong readme.txt.
Cập nhật changelog. Chạy node tests/contact-icons.cjs và php -l trên PHP.
Commit/push main, chờ kiểm thử GitHub Actions, tạo và push tag vX.Y.Z.
Workflow kiểm tra PHP 7.2/8.3, JavaScript và đóng ZIP; tạo Release khi kiểm thử đạt.
Không sửa nội dung hoặc ZIP của Release đã phát hành; luôn tăng phiên bản.

## Hoàn tác
Giữ ZIP 1.0.0 và bản tốt gần nhất ngoài repo. Nếu lỗi, tắt tự cập nhật riêng plugin rồi cài lại ZIP bản tốt qua WordPress; làm mới cache.
Nếu cần tự cập nhật bản sửa, phát hành nội dung bản tốt với số phiên bản cao hơn.
GitHub lỗi mạng không đổi code đang cài; updater sẽ thử lại theo lịch.

## Xác minh bản 1.1.1
Bản này chỉ cập nhật tài liệu và số phiên bản để kiểm tra đường GitHub → WordPress.
Icon, màu, vị trí và đường dẫn giữ nguyên. Tự cập nhật diễn ra theo lịch WordPress;
việc đã bật tùy chọn tự cập nhật không chứng minh một lần tự cài đã hoàn tất.

## Cover test 1.3.0
Thay riêng slider hero trang chủ bằng GIF sinh nhật 6 năm, giữ tỉ lệ 3:1, rộng 100% khung nội dung và không cắt hình. GIF gốc 600×200, khoảng 7,6 MiB; phóng lớn sẽ mềm nét và tải chậm hơn ảnh tĩnh. Giữ nguyên file động theo yêu cầu.
Không sửa nội dung trong cơ sở dữ liệu: slider và liên kết cũ vẫn nằm nguyên trong UX Builder. Bỏ chọn **Cài đặt → MTT Cover trang chủ → Bật cover GIF sinh nhật 6 năm** rồi lưu và xóa cache để quay lại.
Mặc định bật khi cập nhật 1.3.0. Nếu không đăng nhập WordPress, phát hành bản mới đặt `MTT_VINA_HOME_COVER_DEFAULT` thành false (khi chưa lưu tùy chọn); nếu đã lưu tùy chọn, bản hoàn tác cần cho hàm enabled trả về false. Không sửa release cũ. Vô hiệu hóa toàn plugin cũng khôi phục slider nhưng đồng thời tắt tùy chỉnh icon.
Chỉ khớp shortcode ux_slider chứa cả hai tiêu đề hero đã xác minh trên trang công khai. Nếu cấu trúc nguồn khác, giữ nguyên cover cũ thay vì thay nhầm nội dung.
Nút MORE INFO nằm trong GIF là nội dung ảnh; không tự thêm đường dẫn chưa được chỉ định.

## Hoàn tác cover 1.3.1
Ngừng nạp module cover test, kể cả khi tùy chọn cũ đã bật. WordPress hiển thị nguyên slider từ UX Builder. Không sửa cơ sở dữ liệu, không thay đổi icon liên hệ. Phần mô tả 1.3.0 phía trên chỉ là lịch sử. Chờ tự cập nhật và cache hết hạn để thấy bản cũ.


## Giới thiệu test 1.4.0
Thay riêng khối Giới thiệu đã xác minh trên trang chủ bằng bố cục được duyệt: nội dung trái, ảnh nhà xưởng hiện tại bên phải, bốn thế mạnh và hiệu ứng khi cuộn. Giữ nguyên đoạn văn, ảnh/srcset, URL nút CTA và ID section. Không đổi canonical, metadata, URL trang, cover hoặc icon. Không có bộ đếm số. Hỗ trợ reduced-motion và hiển thị đầy đủ nếu JavaScript không chạy.

Mặc định bật khi cập nhật. Vào **Cài đặt → MTT Giới thiệu trang chủ**, bỏ chọn **Bật thiết kế Giới thiệu mới trên trang chủ**, lưu và xóa cache trang chủ để quay về khối ban đầu. Công tắc đã tắt được giữ nguyên qua các lần cập nhật. Không cần vô hiệu hóa toàn plugin.

Khối gốc giữ nguyên trong cơ sở dữ liệu UX Builder: plugin chỉ thay kết quả render của đúng shortcode section trên trang chủ. Nếu nội dung, ảnh hoặc cấu trúc khối nguồn không còn khớp bản đã xác minh, plugin giữ nguyên khối đó thay vì ghi đè thay đổi mới. Muốn sửa nội dung trong UX Builder: tắt công tắc trước.

Nếu cần hoàn tác qua GitHub mà không vào WordPress, phát hành phiên bản cao hơn ngừng nạp module `assets/home-about.php`; không sửa release đã phát hành. Bản HTML công khai dùng kiểm thử nằm tại `tests/fixtures/home-about-original.html`, không thay thế backup cơ sở dữ liệu.

Kiểm thử bổ sung: `php tests/home-about.php`, `node tests/home-about.cjs`.

## Hoàn tác Giới thiệu 1.4.1
Ngừng nạp module Giới thiệu test, kể cả khi tùy chọn đã bật. Khối ban đầu được hiển thị nguyên từ UX Builder; không thay đổi cơ sở dữ liệu, cover hoặc icon liên hệ. Trang cấu hình test cũng ngừng nạp. Mô tả 1.4.0 phía trên chỉ là lịch sử. WordPress cần nhận bản cập nhật và cache được làm mới để thấy kết quả.
