<!-- Sub banner start -->
<div class="sub-banner text-center">
    <div class="page-title">
        <h1><?= isset($title_2) ? $title_2 : ''; ?></h1>
    </div>
</div>
<!-- Sub Banner end -->
<section id="breadcrumb">
    <div class="container breadcrumb-area">
        <div class="breadcrumb-areas">
            <ul class="breadcrumbs">
                <li><a href="<?= base_url() ?>">Home</a></li>
                <li class="active"><?= isset($title) ? $title : ''; ?></li>
            </ul>
        </div>
    </div>
</section>

<div class="contact_us content-area">
    <div class="container">
        <form id="form_data">
            <div id="alert_notif"></div>
            <div class="row">
                <div class="col-md-10 form-group">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 form-group">
                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone">
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 form-group">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 form-group">
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 form-group">
                    <textarea class="form-control" id="message" rows="5" name="message" placeholder="Your Message"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 form-group">
                    <div id="captcha_el" class="g-recaptcha" data-sitekey="6Lfz1LcUAAAAAPIx6KW33lR1vMpFlT_826O6NLFO"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 form-group">
                    <button type="button" id="btn-send" class="btn btn-primary btn-block">Send Message</button>
                </div>
            </div>
        </form>
    </div>
</div>