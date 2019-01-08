<?php status_header(200); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php wp_head(); ?>
  <link rel="stylesheet" href="https://unpkg.com/vue2-animate/dist/vue2-animate.min.css"/>
</head>
<body>
<script>
	var  global_page_id = '<?php global $post; echo $post->ID ?>';
  var  root_site_path = '<?php bloginfo('url')?>';
  var current_page_url = '<?php global $wp; echo home_url( $wp->request ) ?>'
  //console.log(global_page_id);
</script>
  
  <div id="app"></div>

  <div id="contact-wrap">
	    <div class="triangle"></div>
	    <div id="contact-inner" class="wow bounceIn" data-wow-delay=".5s">
		  <h3>Get in touch!</h3>
		  <p class="results">I'm currently accepting freelance projects, so feel free to drop me a line if you're interested!</p>
		    <form id="gf_web_api_form">
          <div class="flex-wrap input-wrap">
		  		  <input id="input_2_1" name="input_2_1" type="text" placeholder="First Name" required/>
            <input id="input_2_2" name="input_2_2" type="text" placeholder="Last Name" required/>
          </div>
          <div class="full-width input-wrap">
            <input id="input_2_3"  name="input_2_3" type="email" placeholder="Email" required/>
          </div>
		  		<textarea id="input_2_4" name="input_2_4" placeholder="Questions/Comments" required></textarea>
		  		<div class="submit-wrap input-wrap">
		  			<button id="submit_button" type="submit" class="button button-primary button-large hvr-grow-shadow ">Submit Form</button>
		  		</div>
		  	</form>
		  </div>
    </div>
  <?php wp_footer(); ?>
  <script>
    $(document).ready(function() {

      $('#gf_web_api_form').parsley({
	    trigger: 'change',
    });

  $("#gf_web_api_form").on('submit', function(e){
    e.preventDefault();
    var form = $(this);

    form.parsley({trigger: 'change',}).validate();

    if (form.parsley().isValid()){
        var url = 'http://localhost/jm-vue/gravityformsapi/forms/1/submissions/';
       submitForm( url );
    }
  });
  
var $sending = $('.sending');
var $results = $('.results');

function submitForm(url){

var inputValues = {
    input_1: $('#input_2_1').val(),
    input_2: $('#input_2_2').val(),
    input_3: $('#input_2_3').val(),
    input_4: $('#input_2_4').val()
};

var data = {
    input_values: inputValues
};

$.ajax({
    url: url,
    type: 'POST',
    data: JSON.stringify(data),
    beforeSend: function (xhr, opts) {
        $sending.show();
    }
})
.done(function (data, textStatus, xhr) {
    $sending.hide();
    $("#gf_web_api_form").slideUp();
    var response = JSON.stringify(data.response.confirmation_message, null, '\t');
    $results.html(response.replace(/\"/g, ""));
    $('.contact-form p').fadeOut();
    $('.form-wrap').addClass('hide');
})
}
});
</script>

</body>
</html>