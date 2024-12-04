<style>

* {
    box-sizing: border-box;
}

.sr-only {
position:absolute;
left:-10000px;
top:auto;
width:1px;
height:1px;
overflow:hidden;
}


    .container {
        max-width: 900px;
        margin: auto;
    }

    .button {
        background:#ff729c;
        color: #fff;
        border-radius: 6px;
        padding: 15px 30px;
        font-size: 18px;
        font-weight: bold;
        transition: 300ms all;
    }

    .button:hover,
    .button:focus {
        background:#545454;
    }

    .logo {
        max-height: 400px;
        margin:auto;
    }

    .logo-small {
        max-height: 200px;
    }

    .input-label {
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
        margin-left: 25px;
    }

    .input {
        margin-top: 1px;
        width: 100%;
        display: block;
        border-radius: 35px;
        border: 2px solid #ff729c;
        padding: 20px 40px;
        font-size: 18px;
        transition: 300ms all;
    }

    .input:focus {
        border: 2px solid #545454;
        box-shadow: 0px 0px 10px -5px #545454;
    }

    .login-form {
        padding-left: 20px;
        padding-right: 20px;
        max-width: 500px;
        margin: auto;
    }

    .search-form {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

.search-box {
    margin-top: 1px;
    width: 100%;
    display: block;
    border-radius: 35px;
    border: 2px solid #ff729c;
    padding: 10px 20px;
    font-size: 18px;
transition: 300ms all;
}
.search-button {
    flex-shrink: 0;
    width: 50px;
    height: 50px;
    background: #ff729c;
    border-radius: 50%;
    color: #fff;
    margin-left: -50px;
}
</style>