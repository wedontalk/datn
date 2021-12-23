@extends('layouts.site')
@section('main')

      <!-- Breadcrumb Section Begin -->
      <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Trang Chủ</a>
                        <span>Liên Hệ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Map Section Begin -->
    <div class="map spad">
        <div class="container">
            <div class="map-inner">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d777.6792045623434!2d106.68963951962075!3d10.791563614235425!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528cd13d0be2d%3A0x45f4b899ebe6bae9!2zMTU5IFRy4bqnbiBRdWFuZyBLaOG6o2ksIFTDom4gxJDhu4tuaCwgUXXhuq1uIDEsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2sus!4v1638534868702!5m2!1svi!2sus"
                    height="610" style="border:0" allowfullscreen="">
                </iframe>
                <div class="icon">
                    <i class="fa fa-map-marker"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Map Section Begin -->

    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-title">
                        <h4>Liên hệ với chúng tôi</h4>
                        <p>Nhóm truyền thông của chúng tôi hợp tác chặt chẽ với các phương tiện truyền thông và các đối tác xã hội để giải quyết các vấn đề liên quan đến điều kiện sống của thú cưng. Chúng tôi mong muốn hỗ trợ bằng công nghệ cao và phong cách sống lành mạnh cho cả con người và vật nuôi.</p>
                    </div>
                    <div class="contact-widget">
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-location-pin"></i>
                            </div>
                            <div class="ci-text">
                                <span>Địa Chỉ:</span>
                                <p>159 Trần Quang Khải, Tân Định, Quận 1, Thành phố Hồ Chí Minh</p>
                            </div>
                        </div>
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="ci-text">
                                <span>Điện Thoại:</span>
                                <p>+84 0964835192</p>
                            </div>
                        </div>
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-email"></i>
                            </div>
                            <div class="ci-text">
                                <span>Email:</span>
                                <p>petshop@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="contact-form">
                        <div class="leave-comment">
                            <h4>Để lại bình luận</h4>
                            <p>Nhân viên của chúng tôi sẽ gọi lại sau và giải đáp các thắc mắc của bạn.</p>
                            <form action="{{URL::To('/mail-contact')}}" class="comment-form" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" name="name" placeholder="Họ Và Tên">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="email" name="email" placeholder="email">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea placeholder="Tin Nhắn" name="note"></textarea>
                                        <button type="submit" class="site-btn">Gửi Tin Nhắn</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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

  tab.onclick = function () {
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