@extends('layouts.site')
@section('main')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Contact</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Map Section Begin -->
    <section>
        <div style="width:100%"><img src="http://localhost:8000/site/img/logo1.png" alt="" style="width: 300px;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: auto;
                margin-top: 51px;"></div>
                <div class="container" style="margin-top:50px">
                    <p style="line-height: 50px;
                    font-size: 18px;">Tại hệ thống cửa hàng bán đồ cho chó mèo thú cưng Pet Shop, kiến thức thú y chuyên môn, kỹ năng chăm sóc chuyên nghiệp và sự tận tâm trong công việc là những tiêu chí hàng đầu đối với đội ngũ nhân viên. Với sự sáng tạo và đổi mới không ngừng trong kinh doanh, Pet Shop hiện đang là một trong những địa điểm hàng đầu chuyên cung cấp những dịch vụ, sản phẩm cho thú cưng như sau:
                      <br>  🐩 Pet Shop là nuôi dưỡng và nhân giống các dòng thú cưng nhỏ như dòng toydog (chó cảnh nhỏ) : poodle (tiny, tcup) , pomeranian, phốc sóc, yorkshire, mini schnauzer... mèo cảnh Mèo Anh lông ngắn (silver, golden, bicolor...), mèo chân lùn (munchkin), mèo không lông, mèo dragdoll.... Tất cả các bé tại Pet Shop điều được theo dõi nghiêm ngặt tiêm phòng, xổ giun, ngừa kí sinh trùng đảm bảo sức khoẻ trước khi về nhà mới. Với nguồn gốc bố mẹ rõ ràng, nhập khẩu từ Nga, Thái , Hàn Quốc...đảm bảo thế hệ con luôn xinh đẹp khoẻ mạnh.</p>
                </div>


    </section>
    <!-- Contact Section End -->
    <script>
        const $ = document.querySelector.bind(document);
        const $$ = document.querySelectorAll.bind(document);

        const tabs = $$(".tab-item");
        const panes = $$(".tab-pane");

        const tabActive = $(".tab-item.active");
        const line = $(".tabs .line");

        line.style.left = tabActive.offsetLeft + "px";
        line.style.width = tabActive.offsetWidth + "px";

        tabs.forEach((tab, index) => {
            const pane = panes[index];

            tab.onclick = function() {
                $(".tab-item.active").classList.remove("active");
                $(".tab-pane.active").classList.remove("active");

                line.style.left = this.offsetLeft + "px";
                line.style.width = this.offsetWidth + "px";

                this.classList.add("active");
                pane.classList.add("active");
            };
        });
    </script>
@endsection
