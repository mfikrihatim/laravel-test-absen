<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('auth/style.css') }}" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="{{ route('loginProcess') }}" method="POST" class="sign-in-form">
            @csrf

            @if (session('gagal'))
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('gagal') }}
            </div>
            @endif

            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input id="email" name="email" placeholder="Email" type="text" class="input form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required><br>
              @error('email')
                <div class="alert alert-danger">{{$message}} <a href="{{ route('loginView') }}">Klik untuk login</a></div>
              @enderror
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input class="form-control @error('email') is-invalid @enderror" type="password" name="password" placeholder="Password">
              @error('password')
                  <div class="alert alert-danger">{{$message}}</div>
              @enderror
            </div>
            <input type="submit" value="Login" class="btn solid" />
            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
          <form action="{{ route('RegisterProcess') }}" method="POST" class="sign-up-form">
            @csrf

            @if (session('gagal'))
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('gagal') }}
            </div>
            @endif

            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
               <input placeholder="Username" name="username" type="text" class="input form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required><br>
              @error('username')
                <div class="alert alert-danger">{{$message}}</div>
              @enderror
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input placeholder="Email" id="email" name="email" type="text" class="input form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required><br>
              @error('email')
                <div class="alert alert-danger">{{$message}} <a href="{{ route('loginView') }}">Klik untuk login</a></div>
              @enderror
            </div>
            <div class="input-field">
              <i class="fas fa-address-card"></i>
              <input type="text" placeholder="Nama Lengkap" name="nama_lngkp" class="input form-control @error('nama_lngkp') is-invalid @enderror" value="{{ old('nama_lngkp') }}" required><br>
              @error('nama_lngkp')
                <div class="alert alert-danger">{{$message}}</div>
              @enderror
            </div>
            <div class="input-field">
              <select type="text" placeholder="Jenis Kelamin" name="jns_kelamin" class="form-control @error('jns_kelamin') is-invalid @enderror" value="{{ old('jns_kelamin') }}" required >
                <option>Laki Laki</option>
                <option>Perempuan</option>
              </select>
              <br>
              @error('jns_kelamin')
                <div class="alert alert-danger">{{$message}}</div>
              @enderror
            </div>
            <div class="input-field">
              <i class="fas fa-child"></i>
              <select type="text" placeholder="Choose Patner" name="choose_patner" class="form-control @error('choose_patner') is-invalid @enderror" value="{{ old('choose_patner') }}" required >
                <option>Find A Patner</option>
                <option>Find A Patner</option>
              </select>
              <br>
              @error('choose_patner')
                <div class="alert alert-danger">{{$message}}</div>
              @enderror
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input placeholder="Password" class="form-control @error('email') is-invalid @enderror" type="password" name="password">
              @error('password')
                  <div class="alert alert-danger">{{$message}}</div>
              @enderror
            </div>
            <input type="submit" class="btn" value="Sign up" />
            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
              ex ratione. Aliquid!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="{{ url('auth/img/log.svg') }}" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
              laboriosam ad deleniti.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="{{ url('auth/img/register.svg') }}" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="{{ url('auth/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
