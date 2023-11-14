

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>WorkWise Html Template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/line-awesome.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/line-awesome-font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('lib/slick/slick.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('lib/slick/slick-theme.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}">
</head>

<body>

	<div class="wrapper">
		<header>
			<div class="container">
				<div class="header-data">
					<nav>
						<ul>
							<li>
								<a href="{{route('home')}}" title="">
									Home
								</a>
							</li>
							<li>
								<a href="#" title="" class="not-box-open">
									<span class="notificationCounter" {!!(count($notifications) > 0) ? '' : 'style="display: none;"'!!}>{{count($notifications)}}</span>
									Notifications
								</a>
								<div class="notification-box noti" id="notification">
									<div class="nott-list">
						  				<div class="view-all-nots">
                                            @foreach ($notifications as $notification)
                                            @php
                                                $notContent = json_decode($notification->text);
                                            @endphp
                                            <div class="notification-details" data-id="{{$notification->id}}">
                                                <div class="notification-info">
                                                    <h3><a href="{{route('content-single', $notContent->contentId)}}">{{$notContent->message}}</a></h3>
                                                    <br>
                                                    <span>{{$notification->created_at}}</span>
                                                </div>
                                            </div>
                                            @endforeach
						  				</div>
									</div><!--nott-list end-->
								</div><!--notification-box end-->
							</li>
						</ul>
					</nav><!--nav end-->
					<div class="menu-btn">
						<a href="#" title=""><i class="fa fa-bars"></i></a>
					</div><!--menu-btn end-->
					<div class="user-account">
						<div class="user-info">
							<img src="images/user.png" alt="">
							<a href="#" title="">{{auth()->user()->name}}</a>
							<i class="la la-sort-down"></i>
						</div>
						<div class="user-account-settingss" id="users">
							<h3 class="tc"><a href="{{route('logout')}}" title="">Logout</a></h3>
						</div><!--user-account-settingss end-->
					</div>
				</div><!--header-data end-->
			</div>
		</header><!--header end-->

		<main>
			<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
							<div class="col-lg-3 col-md-4 pd-left-none no-pd">
								<div class="main-left-sidebar no-margin">
									<div class="user-data full-width">
										<div class="user-profile">
											<div class="username-dt">
												<div class="usr-pic">
													<h3 style="color:white">About</h3>
												</div>
											</div><!--username-dt end-->
											<div class="user-specs">
												<h3>{{auth()->user()->name}}</h3>
											</div>
										</div><!--user-profile end-->
									</div><!--user-data end-->
								</div><!--main-left-sidebar end-->
							</div>
							<div class="col-lg-6 col-md-8 no-pd">
								<div class="main-ws-sec">
									<div class="post-topbar">
										<div class="post-st">
											<ul>
												<li><a class="post-jb active" href="#" title="">Post a Content</a></li>
											</ul>
										</div><!--post-st end-->
									</div><!--post-topbar end-->
									<div class="posts-section">

                                        @foreach ($content as $item)
										<div class="post-bar">
											<div class="post_topbar">
												<div class="usy-dt">
													<div class="usy-name">
														<h3>{{$item->user->name}}</h3>
													</div>
												</div>
											</div>
											<div class="job_descp">
												<h3>{{$item->title}}</h3>
												<ul class="job-dt">
													<li><a href="#" title="">{{$item['release_date']}}</a></li>
													<li>$<span>{{$item->price}}</span></li>
												</ul>
												<p>{{substr($item->text, 0, 60)}}..<a href="#" title="">view more</a></p>
												{{-- <ul class="skill-tags">
													<li><a href="#" title="">HTML</a></li>
													<li><a href="#" title="">PHP</a></li>
													<li><a href="#" title="">CSS</a></li>
													<li><a href="#" title="">Javascript</a></li>
													<li><a href="#" title="">Wordpress</a></li>
												</ul> --}}
											</div>
											{{-- <div class="job-status-bar">
												<ul class="like-com">
													<li>
														<a href="#"><i class="fas fa-heart"></i> Like</a>
														<img src="images/liked-img.png" alt="">
														<span>25</span>
													</li>
													<li><a href="#" class="com"><i class="fas fa-comment-alt"></i> Comment 15</a></li>
												</ul>
												<a href="#"><i class="fas fa-eye"></i>Views 50</a>
											</div> --}}
										</div><!--post-bar end-->
                                        @endforeach
										{{-- <div class="process-comm">
											<div class="spinner">
												<div class="bounce1"></div>
												<div class="bounce2"></div>
												<div class="bounce3"></div>
											</div>
										</div><!--process-comm end--> --}}
									</div><!--posts-section end-->
								</div><!--main-ws-sec end-->
							</div>
							<div class="col-lg-3 pd-right-none no-pd">
								<div class="right-sidebar">
								</div><!--right-sidebar end-->
							</div>
						</div>
					</div><!-- main-section-data end-->
				</div>
			</div>
		</main>

		<div class="post-popup job_post">
			<div class="post-project">
				<h3>Post a content</h3>
				<div class="post-project-fields">
					<form action="{{route('content-post')}}" method="POST">
                        @csrf
                        <input type="hidden" name="user_timezone">
						<div class="row">
							<div class="col-lg-12">
								<input type="text" name="title" placeholder="Title">
							</div>
							<div class="col-lg-12">
                                <textarea required name="text" id="" cols="30" rows="10"></textarea>
							</div>
							<div class="col-lg-6">
								<div class="price-br">
									<input type="number" step=".10" name="price" placeholder="Price">
									<i class="la la-dollar"></i>
								</div>
							</div>
                            <div class="col-lg-12">
								<input type="datetime-local" name="release_date" placeholder="Leave blank if you want to publish immediately">
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" value="post">Post</button></li>
									<li><a href="#" title="">Cancel</a></li>
								</ul>
							</div>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-project-popup end-->



	</div><!--theme-layout end-->



<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('lib/slick/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>

    let userId = {{auth()->id()}};
    // Disable on prod
    Pusher.logToConsole = true;

    var pusher = new Pusher('d88336783f29b0391968', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('contents');
    channel.bind('content-released', function(data) {
        if(!data.content)
            return;

        let message = data.content.userId == userId ? "Your content is released!" : data.content.message;
        let notificationHtml = `
        <div class="notification-details" data-id="`+data.content.notificationId+`">
            <div class="notification-info">
                <h3><a href="{{route('content-single', '')}}/`+data.content.contentId+`">`+message+`</a></h3>
                <br>
                <span>Just now</span>
            </div>
        </div>
        `;

        $(notificationHtml).insertBefore($('.nott-list').find('.view-all-nots'));
        $('.notificationCounter').text(parseInt($('.notificationCounter').text())+1).show();
    });
  </script>
  <script>
    $('body').on('click','.not-box-open',function(e){
        var notifications = [];
        console.log($(this).next('.notification-box').find('.notification-details'));
        $(this).next('.notification-box').find('.notification-details').each(function(){
            notifications.push($(this).data('id'));
        });

        $.ajax({
            url: "{{route('notifications-read')}}",
            type: 'POST',
            data: JSON.stringify(notifications),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            success: function(response) {
                $('.notificationCounter').text(0).hide();
            },
            error: function(xhr, status, error) {

            }
        });
    });
  </script>
    <script>
        $('input[name="user_timezone"]').val(Intl.DateTimeFormat().resolvedOptions().timeZone);
    </script>

</body>
</html>
