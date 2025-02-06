from flask import Flask, render_template, redirect, url_for, request

app = Flask(__name__)

@app.route("/", methods=["GET","POST"])
def login():
    if request.method == "POST":
        username = request.form["username"]
        password = request.form["password"]
        if username == "admin" and password == "1234":
            return redirect("https://www.google.com/")
        else:
            return "TOLOL"
    return render_template("login.html")


if __name__ == "__main__":
    app.run(debug=True)