<!DOCTYPE html>
<html>
	<head>
		{% include 'layouts\header.volt' %}
		<title>{% block title %}{% endblock %} - My Webpage</title>
	</head>
	<body>
		<nav>
			<div class="logo"><a href="{{ url("") }}"><img src="img/logo_pweb3.png" alt="logo"></a></div>
			<div class="nav-cont-left">
				<ul>
					<li><a href="{{ url("") }}">Home</a></li>
					<li>Learn
						<ul>
							<li><a href="{{ url("tipsntrick") }}">Tips and Tricks</a></li>
							<li><a href="{{ url("care") }}">Cat Care</a></li>
							<li><a href="{{ url("adopt") }}">Adopt</a></li>
						</ul>
					</li>
					<li><a href="{{ url("report") }}">Find A Cat ?</a></li>
					<li><a href="{{ url("donate") }}">Donate</a></li>
					<li><a href="{{ url("about") }}">About</a></li>
				<ul>
			</div>

			<div class="nav-cont-right">
				<ul>
				{% if session.has('auth') %} 
					<li><a href="{{ url("profile") }}">{{ session.get('auth')['username'] }}</a></li>
					<li><a href="{{ url("logout") }}">Logout</a></li>

				{% else %}
					<li><a href="{{ url("login") }}">Login</a></li>
					<li><a href="{{ url("register") }}">Signup</a></li>

				{% endif %}
		</nav>

		{% block content %}{% endblock %}

		<div class="footer">
			<div class="row">
				<div class="column-base" style="margin-left:130px;">
					<p>Learn more</p>
					<ul><li><a href="{{ url("tipsntrick") }}">Tips and Tricks</a></li>
						<li><a href="{{ url("care") }}">Cat Care</a></li>
						<li><a href="{{ url("adopt") }}">Adopt</a></li>
					</ul>
				</div>
				<div class="column-base" style="margin-right:20px;">
					<p>About</p>
					<ul><li>The Project</li>
						<li>The Program</li>
						<li>The Volunteer</li></ul>
				</div>
				<div class="column-base" style="margin-left:20px;">
					<p>Follow us</p>
					<ul><li><i class="fa fa-facebook-square"></i> IT's Catty Peri</li>
						<li><i class="fa fa-twitter"></i> its_cattyperi</li>
						<li><i class="fa fa-instagram"></i> its.cattyperi</li>
					</ul>
				</div>
				<div class="column-base" style="margin-right:100px;">
					<p>Contact</p>
					<ul><li>(0354)687454</li>
						<li>its_cattyperi@gmail.com</li>
						<li>its.cattyperi@yahoo.com</li>
					</ul>
				</div>
			</div>
		</div>

{% include 'layouts\footer.volt' %}
		</body>
</html>