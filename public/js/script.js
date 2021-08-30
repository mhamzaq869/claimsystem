let elmButton = document.querySelector("#submit");
let csrf = "{{ csrf_field() }}";

console.log('dsd')

if (elmButton) {
    elmButton.addEventListener(
        "click",
        e => {
            elmButton.setAttribute("disabled", "disabled");
            elmButton.textContent = "Opening...";

            fetch("/onboarduser", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        "_token": "{{ csrf_field() }}",
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.url) {
                        window.location = data.url;
                    } else {
                        elmButton.removeAttribute("disabled");
                        elmButton.textContent = "<Something went wrong>";
                        console.log("data", data);
                    }
                });
        },
        false
    );
}
