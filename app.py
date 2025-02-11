from flask import Flask, render_template, redirect, url_for, request

app = Flask(__name__)

@app.route("/", methods=["GET","POST"])
def login():
    if request.method == "POST":
        username = request.form["username"]
        password = request.form["password"]
        if username == "kontol@kontol.com" and password == "kontolkecil":
            return redirect("https://www.google.com/")
        else:
            return "TOLOL"
    return render_template("login.html")

@app.route('/register', methods=['GET','POST'])
def register():
    return render_template('register.html')

@app.route('/index')
def index():
    return render_template('index.html')

@app.route('/approval')
def approval():
    return render_template('approval.html')

@app.route('/report')
def report():
    return render_template('report.html')

if __name__ == "__main__":
    app.run(debug=True, port=8080)