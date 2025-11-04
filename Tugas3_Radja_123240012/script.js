document.addEventListener('DOMContentLoaded', () => {

    const initialStudents = [
        { nim: '123240001', nama: 'Grahito', jenisKelamin: 'Laki-Laki' },
        { nim: '123240089', nama: 'Jeju', jenisKelamin: 'Perempuan' },
    ];

    if (!localStorage.getItem('students')) {
        localStorage.setItem('students', JSON.stringify(initialStudents));
    }

    const studentTableBody = document.getElementById('student-table-body');
    const searchInput = document.getElementById('search-input');
    const addStudentForm = document.getElementById('add-student-form');

    const renderTable = (students) => {
        studentTableBody.innerHTML = '';
        if (!students || students.length === 0) {
            studentTableBody.innerHTML = '<tr><td colspan="5" class="text-center">Data tidak ditemukan.</td></tr>';
            return;
        }
        students.forEach((student, index) => {
            const row = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${student.nim}</td>
                    <td>${student.nama}</td>
                    <td>${student.jenisKelamin}</td>
                    <td>
                        <button class="btn btn-primary btn-sm">Update</button>
                        <button class="btn btn-danger btn-sm delete-btn" data-nim="${student.nim}" data-bs-toggle="modal" data-bs-target="#delete-modal">Delete</button>
                    </td>
                </tr>
            `;
            studentTableBody.innerHTML += row;
        });
    };
    
    const deleteStudent = (nim) => {
        let students = JSON.parse(localStorage.getItem('students')) || [];
        students = students.filter(student => student.nim !== nim);
        localStorage.setItem('students', JSON.stringify(students));
        renderTable(students);
    };

    if (studentTableBody) {
        const allStudents = JSON.parse(localStorage.getItem('students')) || [];
        renderTable(allStudents);

        searchInput.addEventListener('input', (event) => {
            const searchTerm = event.target.value.toLowerCase();
            const students = JSON.parse(localStorage.getItem('students')) || [];
            const filteredStudents = students.filter(student => 
                student.nama.toLowerCase().includes(searchTerm)
            );
            renderTable(filteredStudents);
        });

        let nimToDelete = null;
        studentTableBody.addEventListener('click', (event) => {
            if (event.target.classList.contains('delete-btn')) {
                nimToDelete = event.target.dataset.nim;
            }
        });
        
        const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
        if(confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener('click', () => {
                if (nimToDelete) {
                    deleteStudent(nimToDelete);
                    const modalEl = document.getElementById('delete-modal');
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                    nimToDelete = null;
                }
            });
        }
    }

    if (addStudentForm) {
        addStudentForm.addEventListener('submit', (event) => {
            event.preventDefault(); 
            const nim = document.getElementById('nim').value;
            const nama = document.getElementById('nama').value;
            const jenisKelamin = document.querySelector('input[name="jenisKelamin"]:checked').value;
            const newStudent = { nim, nama, jenisKelamin };
            
            let students = JSON.parse(localStorage.getItem('students')) || [];
            students.push(newStudent);
            localStorage.setItem('students', JSON.stringify(students));
            
            window.location.href = 'index.html';
        });
    }
});