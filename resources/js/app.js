import { createIcons, icons } from "lucide";

document.addEventListener("DOMContentLoaded", () => {
      createIcons({ icons });

    document.querySelectorAll("[data-recipe-id]").forEach((container) => {
        const stars = container.querySelectorAll(".star");
        const recipeId = container.dataset.recipeId;
        const avgRatingEl = container.querySelector(".avg-rating");
        let userVote = null;

        // Highlight stars on hover
        stars.forEach((star, i) => {
            star.addEventListener("mouseover", () => {
                if (userVote !== null) return; // don’t override if user already voted
                resetStars(stars);
                stars.forEach((s, j) => {
                    if (j <= i) s.classList.add("text-yellow-400");
                });
            });

            star.addEventListener("mouseleave", () => {
                if (userVote !== null) {
                    highlightStars(stars, userVote); // lock to user vote
                } else {
                    renderStarsFromAvg(
                        stars,
                        parseInt(avgRatingEl.dataset.avg) || 0
                    );
                }
            });

            // On click: submit rating
            star.addEventListener("click", async () => {
                const score = i + 1; // 1–5
                console.log("CLICKED", { score, index: i });

                userVote = score;
                highlightStars(stars, userVote); // lock stars immediately

                const res = await fetch(`/recipes/${recipeId}/rate`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                    },
                    body: JSON.stringify({ score }),
                });

                if (res.ok) {
                    const data = await res.json(); // { avg: 4.3, votes: 10 }
                    console.log("SERVER RESPONSE", data);
                    avgRatingEl.dataset.avg = data.avg;
                    avgRatingEl.textContent = `${data.avg} (${data.votes} ${
                        data.votes === 1 ? "vote" : "votes"
                    })`;
                    avgRatingEl.dataset.avg = data.avg;
                    renderStarsFromAvg(stars, parseInt(data.avg));
                    window.location.reload(); // refresh after closing
                }
            });
        });

        function highlightStars(stars, count) {
            resetStars(stars);
            stars.forEach((s, i) => {
                if (i < count) s.classList.add("text-yellow-400");
                else s.classList.add("text-gray-600");
            });
        }

        function renderStarsFromAvg(stars, avg) {
            resetStars(stars);
            const rounded = Math.round(avg);
            stars.forEach((s, i) => {
                if (i < rounded) s.classList.add("text-yellow-400");
                else s.classList.add("text-gray-600");
            });
        }

        function resetStars(stars) {
            stars.forEach((s) =>
                s.classList.remove("text-yellow-400", "text-gray-600")
            );
        }
    });
});

// login modal
document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector("#loginForm");

    if (loginForm) {
        loginForm.addEventListener("submit", async (e) => {
            e.preventDefault();

            let formData = new FormData(loginForm);

            let response = await fetch("/login", {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: new FormData(loginForm),
            });

            let data = await response.json();

            if (!response.ok) {
                showLoginError(data.message || "Login failed");
            } else {
                const userName = data.user.name || "User";
                document.querySelector("#loginModalContent").innerHTML = `
                    <div class="p-4 text-center">
                        <h2 class="text-xl font-bold">Welcome back, ${userName}!</h2>
                        <p class="mt-2">You are now logged in.</p>
                    </div>
                `;
                setTimeout(() => closeLoginModal(), 2000); // auto close after 2s
                window.location.reload(); // refresh after closing
            }
        });
    }
});

function showLoginError(message) {
    const errorBox = document.querySelector("#loginError");
    if (errorBox) {
        errorBox.textContent = message;
        errorBox.classList.remove("hidden");
    } else {
        alert(message); // fallback
    }
}

function closeLoginModal() {
    const overlay = document.querySelector("");
    const loginModal = document.querySelector("#loginModalContent");
    if (loginModal) {
        loginModal.classList.add("hidden");
    }
}
