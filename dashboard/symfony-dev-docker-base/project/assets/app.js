import "./stimulus_bootstrap.js";
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.css";

console.log("This log comes from assets/app.js - welcome to AssetMapper! 🎉");

// ── Compteurs par section ──
function updateCounts() {
    const sections = [
        { id: "clients", role: "client" },
        { id: "architectes", role: "architecte" },
        { id: "admins", role: "admin" },
    ];
    sections.forEach(({ id, role }) => {
        const table = document.querySelector(
            `.user-table[data-role="${role}"]`,
        );
        if (!table) return;
        const visible = table.querySelectorAll(
            'tbody .user-row:not([style*="display: none"])',
        ).length;
        document.getElementById(`${id}-count`).textContent = visible;
    });
}

// ── Recherche globale ──
function filterUsers() {
    const query = document.getElementById("search-input").value.toLowerCase();
    document.querySelectorAll(".user-row").forEach((row) => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(query) ? "" : "none";
    });
    updateCounts();
}

// ── Toggle section ──
function toggleSection(id) {
    const table = document.getElementById(`${id}-table`);
    const chevron = document.getElementById(`${id}-chevron`);
    const hidden = table.style.display === "none";
    table.style.display = hidden ? "" : "none";
    chevron.style.transform = hidden ? "rotate(0deg)" : "rotate(-90deg)";
}

// Init compteurs
updateCounts();
