<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Feedback</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 2rem auto;
        background: #f8f9fa;
        color: #333;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    h2,
    h3 {
        text-align: center;
    }

    form {
        background: #fff;
        width: 50%;
        padding: 50px;
        border-radius: 8px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    input,
    textarea {
        display: block;
        width: 100%;
        margin-bottom: 1rem;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        transition: border 0.3s;
    }

    input:focus,
    textarea:focus {
        border-color: #007bff;
        outline: none;
    }

    button {
        background: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 15px;
        transition: background 0.3s;
    }

    button:hover {
        background: #0056b3;
    }

    .alert {
        padding: 12px;
        margin-bottom: 15px;
        border-radius: 6px;
        font-size: 14px;
    }

    .alert.error {
        background: rgba(219, 78, 78, 1);
        border: 1px solid #f99;
        color: #900;
    }

    .alert.success {
        background: rgba(78, 233, 78, 1);
        border: 1px solid #9c9;
        color: #060;
    }

    #feedbackList {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        grid-template-rows: repeat(5, 1fr);
        gap: 8px;
    }

    .feedback {
        border: 1px solid #ccc;
        padding: 12px;
        margin-bottom: 10px;
        border-radius: 6px;
        background: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .feedback h4 {
        margin: 0 0 5px;
        color: #007bff;
    }

    .feedback small {
        color: #555;
    }

    /* Loading Spinner */
    .spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #007bff;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
        margin: 20px auto;
        display: none;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    </style>
</head>

<body>
    <h2>Submit Feedback</h2>

    <div id="alertBox"></div>

    <form id="feedbackForm">
        <input type="text" name="name" placeholder="Your Name" required />
        <input type="email" name="email" placeholder="Your Email" required />
        <textarea name="comments" placeholder="Your Feedback" required></textarea>
        <button type="submit">Submit</button>
    </form>

    <h3>Submitted Feedback</h3>
    <div id="spinner" class="spinner"></div>
    <div id="feedbackList"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#feedbackForm").on("submit", function(e) {
            e.preventDefault();
            const name = $("input[name='name']").val().trim();
            const email = $("input[name='email']").val().trim();
            const comments = $("textarea[name='comments']").val().trim();

            if (name.length < 3)
                return showAlert("error", "Nama minimal 3 huruf");
            if (comments.length < 5)
                return showAlert("error", "Komentar minimal 5 karakter");

            toggleSpinner(true);
            $.ajax({
                url: "api/action-feedback.php?action=post-feedback",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    name,
                    email,
                    comments
                }),
                dataType: "json",
                success: function(res) {
                    if (res.status == 'success') {
                        showAlert("success", res.message);
                        $("#feedbackForm")[0].reset();
                    } else {
                        showAlert("error", res.message);
                    }
                },
                error: function() {
                    showAlert("Terjadi kesalahan saat submit", "error");
                },
                complete: function() {
                    toggleSpinner(false);
                }
            });
        });
    });
    </script>
</body>

</html>