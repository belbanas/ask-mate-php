<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://journey.code.cool/v2/assets/codecool_logo.png" alt="" width="30" height="30"
                     class="d-inline-block align-top">Ask Mate</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto">
                    <a class="nav-link" aria-current="page" href="/">Questions</a>
                    <a class="nav-link" href="/ask">Ask question</a>
                    <a class="nav-link" href="/tags">List tags</a>

                    <a class="nav-link" href="/users">List users</a>
                    <form action='/doSearch' method='POST' id='form_'>
                        <input type="text" name="itemForSearch" id="itemForSearch">
                        <a href=""
                           onclick="document.getElementById('form_').submit(); return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </a>
                    </form>

                    @if (isset($_SESSION['email']))
                        <a class="nav-link" href="/logout">Logout</a>
                    @else
                        <a class="nav-link" href="/login">Login</a>
                    @endif
                </div>
                @if (isset($_SESSION['email']))
                    <span class="navbar-text">Logged in as <b>{{ $_SESSION['email'] }}</b></span>
                @endif
            </div>
        </div>
    </nav>
</div>
