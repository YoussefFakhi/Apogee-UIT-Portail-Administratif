<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande d'inscription administrative</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        /* Base Styles */
        :root {
            --bg-color: #34197e;
            --text-color: #fff;
            --main-color: #ffffff;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --dark-bg: #1a1a1a;
            --card-bg: #2a2a2a;
            --input-bg: #333;
            --input-border: #444;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #000000;
            color: var(--text-color);
            padding: 20px;
        }

        /* Container Styles */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Card Styles */
        .card {
            background: var(--card-bg);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        /* Typography */
        h2, h4 {
            color: var(--main-color);
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
        }

        /* Form Elements */
        .form-label {
            color: var(--main-color);
            margin-bottom: 8px;
            display: block;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid var(--input-border);
            background-color: var(--input-bg);
            color: var(--text-color);
            margin-bottom: 15px;
        }

        .form-control:focus {
            border-color: var(--main-color);
            outline: none;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-primary {
            background-color: var(--bg-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #2a1268;
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        /* Student Rows */
        .student-row {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            align-items: center;
        }

        /* Loading Screen */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            z-index: 1000;
        }

        .loading-text {
            color: var(--main-color);
            margin-top: 15px;
            font-size: 1.2rem;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: var(--main-color);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .student-row {
                flex-direction: column;
            }

            .remove-student-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Demande d'inscription administrative à une année antérieure</h2>



        <!-- Main Form -->
        <div class="card">
            <form id="inscriptionForm">
                <!-- Institution Field -->
                <div class="mb-3">
                    <label class="form-label">Etablissement</label>
                    <input type="text" name="etbl" class="form-control" required>
                </div>

                <!-- Date Field -->
                <div class="mb-3">
                    <label class="form-label">Date de la demande</label>
                    <input type="date" name="dateDM" class="form-control" required>
                </div>

                <!-- Cycle Field -->
                <div class="mb-3">
                    <label class="form-label">Cycle</label>
                    <input type="text" name="typ" class="form-control" required>
                </div>

                <!-- Program Field -->
                <div class="mb-3">
                    <label class="form-label">Filière</label>
                    <input type="text" name="flr" class="form-control" required>
                </div>

                <!-- Request Type Field -->
                <div class="mb-3">
                    <label class="form-label">Nature de la demande</label>
                    <input type="text" name="nrtDM" class="form-control" required>
                </div>

                <!-- Year Field -->
                <div class="mb-3">
                    <label class="form-label">Année d'inscription concernée</label>
                    <input type="text" name="aneINS" class="form-control" required>
                </div>

                <!-- Students List -->
                <h4>Liste des Étudiants</h4>
                <div id="students-container" class="mb-3">
                    <div class="student-row">
                        <input type="text" name="students[0][apogee]" class="form-control" placeholder="Numéro APOGEE" required>
                        <input type="text" name="students[0][name]" class="form-control" placeholder="Nom & Prénom" required>
                        <button type="button" class="btn btn-danger remove-student-btn">❌</button>
                    </div>
                </div>

                <!-- Add Student Button -->
                <button type="button" id="add-student-btn" class="btn btn-success mb-3">+ Ajouter un étudiant</button>

                <!-- Reason Field -->
                <div class="mb-3">
                    <label class="form-label">La raison du retard</label>
                    <textarea name="mtf" rows="4" class="form-control" required></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-block">Générer le PDF</button>
            </form>
        </div>

        <!-- Loading Screen -->
        <div id="loadingScreen" class="loading-overlay">
            <div class="spinner"></div>
            <p class="loading-text">Génération du PDF en cours...</p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('inscriptionForm');
            const loadingScreen = document.getElementById('loadingScreen');
            let studentIndex = 1;

            // Add student row
            document.getElementById("add-student-btn").addEventListener("click", function() {
                const container = document.getElementById("students-container");
                const newStudentRow = document.createElement("div");
                newStudentRow.classList.add("student-row");
                newStudentRow.innerHTML = `
                    <input type="text" name="students[${studentIndex}][apogee]" class="form-control" placeholder="Numéro APOGEE" required>
                    <input type="text" name="students[${studentIndex}][name]" class="form-control" placeholder="Nom & Prénom" required>
                    <button type="button" class="btn btn-danger remove-student-btn">❌</button>
                `;
                container.appendChild(newStudentRow);

                // Remove student row
                newStudentRow.querySelector(".remove-student-btn").addEventListener("click", function() {
                    newStudentRow.remove();
                });

                studentIndex++;
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                loadingScreen.style.display = 'flex';

                // Simulate form processing
                setTimeout(() => {
                    loadingScreen.style.display = 'none';
                    alert('Formulaire soumis avec succès!');

                    // Here you would normally submit the form or generate PDF
                    // form.submit();
                }, 2000);
            });

            // Initialize remove buttons for first student
            document.querySelectorAll('.remove-student-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    this.closest('.student-row').remove();
                });
            });
        });
    </script>
</body>
</html>












