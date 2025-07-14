function archiveResident(residentId) {
    // Show confirmation dialog
    const confirmation = document.createElement('div');
    confirmation.innerHTML = `
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center max-w-sm w-full">
                <h3 class="text-lg font-semibold mb-4">Are you sure you want to archive this resident?</h3>
                <div class="flex justify-center space-x-4">
                    <button id="confirmYes" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Yes</button>
                    <button id="confirmNo" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">No</button>
                </div>
            </div>
        </div>
    `;
    document.body.appendChild(confirmation);

    document.getElementById('confirmYes').onclick = () => {
        const residentsRef = firebase.database().ref('Residents/' + residentId);
        const archivedRef = firebase.database().ref('Archived_Resident/' + residentId);

        // Capture current date and time in Philippine Time (en-PH format)
        const now = new Date();
        const formattedDate = new Date(now.toLocaleString("en-PH", { timeZone: "Asia/Manila" }))
            .toLocaleString('en-PH', { 
                timeZone: 'Asia/Manila', 
                hour12: true, 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit', 
                year: 'numeric', 
                month: '2-digit', 
                day: '2-digit' 
            });

        // Retrieve the logged-in user's email and role (stored in cookies)
        const email = getCookie('email');  
        const role = getCookie('role');    

        // Retrieve the resident data
        residentsRef.once('value').then(snapshot => {
            const residentData = snapshot.val();

            if (residentData) {
                // Add archive timestamp, email, and role to resident data
                residentData.archived_at = formattedDate;
                residentData.archived_by = email;
                residentData.archived_role = role;

                // Move data to Archived_Resident table with the archive timestamp
                archivedRef.set(residentData).then(() => {
                    // After archiving, remove from Residents table
                    residentsRef.remove().then(() => {
                        // Log the archiving action (email, role, and timestamp)
                        const logRef = firebase.database().ref('Logs');
                        logRef.push({
                            action: 'archive',
                            residentId: residentId,
                            archivedBy: email,
                            role: role,
                            archivedAt: formattedDate
                        }).then(() => {
                            showFloatingMessage('Resident archived successfully.');
                            window.location.reload();  // Refresh the page to reflect changes
                        }).catch(error => {
                            console.error('Error logging the action:', error);
                            alert('Failed to log the archiving action.');
                        });
                    }).catch(error => {
                        console.error('Error removing resident from Residents table:', error);
                        alert('Failed to remove resident from the Residents table.');
                    });
                }).catch(error => {
                    console.error('Error archiving resident to Archived_Resident table:', error);
                    alert('Failed to archive resident.');
                });
            } else {
                alert('Resident not found.');
            }
        }).catch(error => {
            console.error('Error retrieving resident data:', error);
            alert('Failed to retrieve resident data.');
        });

        document.body.removeChild(confirmation);
    };

    document.getElementById('confirmNo').onclick = () => {
        document.body.removeChild(confirmation);
    };
}

// Helper function to get the value of a cookie
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

function deleteResident(residentId) {
    const residentRef = firebase.database().ref('Archived_Resident/' + residentId);

    residentRef.remove().then(() => {
        alert('Resident deleted successfully!');
        location.reload();
    }).catch((error) => {
        console.error('Error deleting resident:', error);
        alert('Failed to delete resident.');
    });
}

function confirmDeleteResident(residentId) {
    if (confirm('Are you sure you want to delete this resident?')) {
        deleteResident(residentId);
    }
}

// Function to display a floating success message
function showFloatingMessage(message) {
    const messageDiv = document.createElement('div');
    messageDiv.innerText = message;
    messageDiv.className = 'fixed top-10 left-1/2 transform -translate-x-1/2 bg-green-500 text-white py-2 px-4 rounded shadow-lg z-50';
    document.body.appendChild(messageDiv);

    // Remove the message after 3 seconds
    setTimeout(() => {
        messageDiv.remove();
    }, 5000);
}
