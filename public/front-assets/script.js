// Update user online status
// function updateOnlineStatus() {
//     if (navigator.onLine) {
//         // User is online
//         fetch("/api/user/online", {
//             method: "POST",
//             headers: {
//                 "Content-Type": "application/json",
//                 "X-CSRF-TOKEN": document
//                     .querySelector('meta[name="csrf-token"]')
//                     .getAttribute("content"),
//             },
//         }).catch(console.error);
//     }
// }

// Listen for online/offline events
// window.addEventListener("online", updateOnlineStatus);
// window.addEventListener("offline", updateOnlineStatus);

// Update status on page load
// document.addEventListener("DOMContentLoaded", updateOnlineStatus);

// // Update status before page unload
// window.addEventListener("beforeunload", function () {
//     if (navigator.sendBeacon) {
//         navigator.sendBeacon("/api/user/offline", JSON.stringify({}));
//     }
// });
