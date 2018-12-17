{% extends "layouts\base.volt" %}


{% block title %} Halaman Utama Saya {% endblock %}

{% block content %}
<div class="home" style="padding-bottom: 0 !important; padding-top: 0 !important; margin-bottom:0;">
	<video autoplay muted loop id="video-background">
  		<source src="video/cat.mp4" type="video/mp4">
  		Your browser does not support HTML5 video.
	</video>

	<img src="img/paint.png" class="centered5 img-home" style="width:50vw;height:10vw;">

	<div class="card centered" style="top:20%;margin-left:15vw;width:42vw;height:28vw;opacity:0.9;">
		<h1 class="centered5" style="top:30%;">
	  		<a href="" class="typewrite" data-period="2000" data-type='[ "ITs Catty Peri" ]'>
	    	<span class="wrap"></span>
	  		</a>
		</h1>
		<h1 class="centered5" style="top:43%;">
	  		<a href="" class="typewrite" data-period="4000" data-type='[ "We Help.", "We Protect.", "We Care."  ]'>
	    	<span class="wrap"></span>
	  		</a>
		</h1>
		<div class="row" style="margin-left:5vw;margin-top:5vw;">
			<div class="col-md-6"><a href="{{ url("donate") }}"><button>Donate</button></a></div>
			<div class="col-md-6">
				{% if session.has('auth') %} 
				<a href="{{ url("adopt") }}"><button>Adopt</button></a></div>
				{% else %}
				<a href="{{ url("login") }}"><button>Login</button></a></div>
				{% endif %}
			</div>
		</div>
	</div>
</div>

<div class="cattyperi">
	<div class="scroll-animate"><img src="img/logo_pweb3.png" alt="logo"></div>
	<div class="scroll-animate"><p>You can help several feral cats around ITS by restoring some help. Together, we will save their life, give new home and family, also bring the bright future and happiness .</p></div>
</div>


<div class="scroll-animate">
	<div class="row">
		<div class="column">
			<h2>Big population of cats is a concern that need to be solved</h2>

			<p>Controlling the growth of cats in ITS and surrounding is a challenge for us to mantain the sustainable population between living things, especially animal and also the public convinence.  By adopting them, you can rescue and  lift this burden.<br><br>
			Moreover, looking for appropriate keeper is better than put the cat to the shelter. It will reduce the number of cat rapidly and avoid the overflowing population in animal shelter.</p>
			<button><span>Read</span></button>
		</div>
		<div class="column">
			<img src="img/cat.jpg">
		</div>
	</div>
</div>

<div class="scroll-animate">
	<div class="row">
		<div class="column"><img src="img/cat1.jpg"></div>
		<div class="column">
			<h2>Threatened cats should be treated </h2>

			<p>Many cats and kittens around ITS often ignore by people. Sometimes, their life only depend on leftover food and mercy by random person. Because of that, feral cats usually suffer many kind of diseases and injuries . With a charitable donation, you can assist them to get treatment and proper nutrition. <br><br>
			Different donate choice are provided to give flexibility for determining which cats that become your priority.
			</p>
			<button><span>Read</span></button>
		</div>
	</div>
</div>

<div class="scroll-animate">
	<div class="row">
		<div class="column">
			<h2>Our temporary shelter resettle for cats </h2>

			<p>Due to crucial condition, a few of cat need intensive guarding. If you find several cats that look like unhealthy in ITS and surrounding, you can leave the cat to us. <br><br>
			By registering immediately, you will speed up the handling of cats 
			</p>
			<button><span>Read</span></button>
		</div>
		<div class="column"><img src="img/cat2.jpg"></div>
	</div>
</div>

<div class="scroll-animate">
	<div class="row">
	<div class="column"><img src="img/cat3.png"></div>
		<div class="column">
			<h2>Giving affection after adopting cats</h2>

			<p>On occasion, dealing with cats is complex, especially the new cat. Begin with how to check their daily condition and nutrition and take care of them. With several tips and tricks that will you get, you can do it easily. <br><br>
			Beside that, you can join and comment with other user for sharing experience.
			</p>
			<a href="{{ url("adopt") }}"><button><span>Adopt</span></button></a>
		</div>
	</div>
</div>

{% endblock %}