



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</head>
<body>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        @if ($errors->any())
        <div class="row">
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        </div>
    @endif
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">Change Password</h1>
                <p class="col-lg-10 fs-4">by <a target="_blank" href="https://www.programmerzamannow.com/">{{$user->name}}</a></p>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="/change-password">
                    @csrf
                    <div class="form-floating mb-3">
                        <input name="old_password" type="password" class="form-control" id="old_password" placeholder="Old Password">
                        <label for="old_password">Old Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="new_password" type="password" class="form-control" id="new_password" placeholder="New Password">
                        <label for="new_password">New Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="re_password" type="password" class="form-control" id="re_password" placeholder="Re-enter Password">
                        <label for="re_password">Re-enter Password</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Change Password</button>
                    <a href="/todo" class="w-100 mt-2 btn btn-success">Back todo</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>