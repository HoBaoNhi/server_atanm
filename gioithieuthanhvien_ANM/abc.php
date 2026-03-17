<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống giới thiệu thành viên - Nhóm 13</title>
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --success-color: #10b981;
            --error-color: #ef4444;
            --bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            --card-bg: #ffffff;
            --text-main: #1f2937;
            --text-sub: #6b7280;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background: var(--bg-gradient);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            color: var(--text-main);
        }

        /* --- Animations --- */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Views Management --- */
        .view-section {
            display: none;
            width: 100%;
            max-width: 1200px;
            animation: fadeIn 0.5s ease-out;
        }

        .view-section.active {
            display: block;
        }

        /* --- Auth Status Bar --- */
        #auth-status-bar {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 24px;
            background: white;
            border-radius: 50px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            display: none;
            align-items: center;
            gap: 12px;
            z-index: 100;
        }

        .status-indicator {
            width: 10px;
            height: 10px;
            background: var(--success-color);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--success-color);
        }

        /* --- Header --- */
        .header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .header h1 {
            font-size: 2.8rem;
            margin-bottom: 0.75rem;
            background: linear-gradient(to right, #4f46e5, #9333ea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* --- Team List --- */
        .team-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2.5rem;
        }

        .member-card {
            background: var(--card-bg);
            border-radius: 2rem;
            padding: 3rem 2rem;
            text-align: center;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .member-card:hover {
            transform: translateY(-10px);
        }

        .avatar-box {
            width: 120px;
            height: 120px;
            margin: 0 auto 1.5rem;
            background: #f3f4f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid var(--primary-color);
        }

        .btn-open-login {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: none;
            background: var(--primary-color);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        /* --- Profile View --- */
        .profile-card {
            background: white;
            max-width: 800px;
            margin: 0 auto;
            border-radius: 2.5rem;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
        }

        .profile-header {
            background: var(--primary-color);
            height: 150px;
            position: relative;
        }

        .profile-body {
            padding: 5rem 3rem 3rem;
            text-align: center;
            position: relative;
        }

        .profile-avatar {
            width: 160px;
            height: 160px;
            background: white;
            border-radius: 50%;
            border: 6px solid white;
            position: absolute;
            top: -80px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .profile-info h2 { font-size: 2.2rem; margin-bottom: 0.5rem; }
        .profile-info .role { color: var(--primary-color); font-weight: 700; margin-bottom: 1.5rem; display: block;}
        
        .profile-stats {
            display: flex;
            justify-content: center;
            gap: 4rem;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: #f9fafb;
            border-radius: 1rem;
        }

        .stat-item b { display: block; font-size: 1.3rem; color: var(--text-main); }
        .stat-item span { color: var(--text-sub); font-size: 0.9rem; font-weight: 600; text-transform: uppercase; }

        .profile-bio { 
            line-height: 1.8; 
            color: var(--text-main); 
            margin-bottom: 2rem; 
            padding: 0 1rem;
            text-align: justify;
            background: #fdfdfd;
            border-left: 4px solid var(--primary-color);
            padding: 1rem;
        }

        .profile-actions { display: flex; gap: 1rem; justify-content: center; }

        .btn-back {
            padding: 12px 35px;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            background: white;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        /* --- Modal --- */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-overlay.active { display: flex; }
        .modal-content {
            background: white; padding: 2.5rem; border-radius: 1.5rem;
            width: 90%; max-width: 400px; position: relative;
        }
        .close-modal { position: absolute; top: 15px; right: 15px; border: none; background: none; font-size: 1.5rem; cursor: pointer; }
        .form-group { margin-bottom: 1.25rem; }
        .form-group label { display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 5px; color: var(--text-sub); text-align: left; }
        .form-group input { width: 100%; padding: 12px; border: 1.5px solid #e5e7eb; border-radius: 10px; outline: none; }
        .form-group input:focus { border-color: var(--primary-color); }
        .btn-submit-login { width: 100%; padding: 12px; background: var(--primary-color); color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; }
    </style>
</head>
<body>

    <!-- Auth Status Bar -->
    <div id="auth-status-bar">
        <div class="status-indicator"></div>
        <span id="active-user-name">Đang tải...</span>
    </div>

    <!-- VIEW 1: TEAM LIST -->
    <section id="view-list" class="view-section active">
        <div class="header">
            <h1>Thành Viên Nhóm 13</h1>
            <p>Sử dụng tài khoản được cấp để vào hệ thống</p>
        </div>

        <div class="team-container">
            <div class="member-card">
                <div class="avatar-box">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="var(--primary-color)"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
                <span class="member-role">Kỹ Thuật</span>
                <h2 class="member-name">Trương Vang Việt</h2>
                <button class="btn-open-login" onclick="openLoginModal('Trương Vang Việt')">Đăng nhập</button>
            </div>

            <div class="member-card">
                <div class="avatar-box">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="var(--primary-color)"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
                <span class="member-role">Trưởng Nhóm</span>
                <h2 class="member-name">Quốc Hùng</h2>
                <button class="btn-open-login" onclick="openLoginModal('Quốc Hùng')">Đăng nhập</button>
            </div>

            <div class="member-card">
                <div class="avatar-box">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="var(--primary-color)"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
                <span class="member-role">Thiết Kế</span>
                <h2 class="member-name">Bảo Nhi</h2>
                <button class="btn-open-login" onclick="openLoginModal('Bảo Nhi')">Đăng nhập</button>
            </div>
        </div>
    </section>

    <!-- VIEW 2: PROFILE VIEW -->
    <section id="view-profile" class="view-section">
        <div class="profile-card">
            <div class="profile-header"></div>
            <div class="profile-body">
                <div class="profile-avatar">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="var(--primary-color)"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
                <div class="profile-info">
                    <h2 id="p-name">Tên Thành Viên</h2>
                    <span class="role" id="p-role">Vai trò</span>
                </div>
                
                <div class="profile-stats">
                    <div class="stat-item">
                        <b id="p-mssv">0</b>
                        <span>MSSV</span>
                    </div>
                    <div class="stat-item">
                        <b id="p-year">Năm 3</b>
                        <span>Năm học</span>
                    </div>
                </div>

                <div style="text-align: left; margin: 0 3rem;">
                    <h3 style="font-size: 1rem; color: var(--primary-color); margin-bottom: 0.5rem; text-transform: uppercase;">Tiểu sử cá nhân</h3>
                    <p class="profile-bio" id="p-bio">Đang tải tiểu sử...</p>
                </div>

                <div class="profile-actions" style="margin-top: 2rem;">
                    <button class="btn-back" onclick="handleLogout()">Đăng xuất & Quay lại</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Đăng nhập -->
    <div id="login-modal" class="modal-overlay">
        <div class="modal-content">
            <button class="close-modal" onclick="closeLoginModal()">&times;</button>
            <div style="text-align: center; margin-bottom: 20px;">
                <h2 id="modal-title-name">Đăng nhập</h2>
                <p style="color: var(--text-sub); font-size: 0.85rem;">Vui lòng nhập đúng thông tin tài khoản nhóm</p>
            </div>
            <div class="form-group">
                <label>Tài khoản</label>
                <input type="text" id="username">
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" id="password" placeholder="••••••••">
            </div>
            <button id="btn-confirm" class="btn-submit-login" onclick="processLogin()">Vào hồ sơ</button>
            <p id="modal-error" style="color: var(--error-color); font-size: 0.8rem; margin-top: 10px; text-align: center; font-weight: 600;"></p>
        </div>
    </div>

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.1.0/firebase-app.js";
        import { getAuth, signInAnonymously, signInWithCustomToken, onAuthStateChanged, signOut } from "https://www.gstatic.com/firebasejs/11.1.0/firebase-auth.js";

        const firebaseConfig = JSON.parse(__firebase_config);
        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);

        // Cấu hình tài khoản duy nhất
        const VALID_USER = "student13";
        const VALID_PASS = "kcntt";

        const memberData = {
            "Trương Vang Việt": {
                role: "Chuyên viên Kỹ Thuật",
                mssv: "4651050319",
                year: "Năm 3",
                bio: "Trương Vang Việt sở thích chơi game và thể thao. Đam mê cầu lông và chạy bộ. Một tuần thường dành thời gian chạy bộ để rèn luyện sức khỏe."
            },
            "Quốc Hùng": {
                role: "Trưởng Nhóm / Quản lý Dự án",
                mssv: "4651050104",
                year: "Năm 3",
                bio: "Với vai trò là người dẫn dắt, Quốc Hùng đảm bảo mọi thành viên luôn đi đúng hướng. Anh có khả năng quản lý thời gian tuyệt vời và kỹ năng giải quyết vấn đề phức tạp một cách nhanh chóng."
            },
            "Bảo Nhi": {
                role: "Nhà Thiết Kế UI/UX",
                mssv: "4651050187",
                year: "Năm 3",
                bio: "Bảo Nhi sở hữu con mắt thẩm mỹ tinh tế. Cô là người tạo ra những giao diện người dùng tuyệt đẹp và trực quan, giúp trải nghiệm của khách hàng luôn ở mức cao nhất."
            }
        };

        let selectedMember = "";

        const switchView = (viewName) => {
            document.querySelectorAll('.view-section').forEach(v => v.classList.remove('active'));
            document.getElementById(`view-${viewName}`).classList.add('active');
        };

        window.openLoginModal = (name) => {
            selectedMember = name;
            document.getElementById('modal-title-name').innerText = `Đăng nhập cho ${name}`;
            document.getElementById('login-modal').classList.add('active');
            document.getElementById('modal-error').innerText = "";
            document.getElementById('username').value = "";
            document.getElementById('password').value = "";
        };

        window.closeLoginModal = () => {
            document.getElementById('login-modal').classList.remove('active');
        };

        window.processLogin = async () => {
            const userInp = document.getElementById('username').value;
            const passInp = document.getElementById('password').value;
            const errorMsg = document.getElementById('modal-error');
            const btn = document.getElementById('btn-confirm');

            if (userInp !== VALID_USER || passInp !== VALID_PASS) {
                errorMsg.innerText = "Sai tài khoản hoặc mật khẩu!";
                return;
            }

            btn.disabled = true;
            btn.innerText = "Đang vào...";

            try {
                if (typeof __initial_auth_token !== 'undefined' && __initial_auth_token) {
                    await signInWithCustomToken(auth, __initial_auth_token);
                } else {
                    await signInAnonymously(auth);
                }
                closeLoginModal();
            } catch (e) {
                errorMsg.innerText = "Lỗi hệ thống.";
                btn.disabled = false;
                btn.innerText = "Vào hồ sơ";
            }
        };

        window.handleLogout = () => signOut(auth);

        onAuthStateChanged(auth, (user) => {
            if (user) {
                const data = memberData[selectedMember] || Object.values(memberData)[0];
                
                // Hiển thị dữ liệu lên web
                document.getElementById('p-name').innerText = selectedMember || "Thành viên";
                document.getElementById('p-role').innerText = data.role;
                document.getElementById('p-mssv').innerText = data.mssv; 
                document.getElementById('p-year').innerText = data.year; 
                document.getElementById('p-bio').innerText = data.bio;   

                document.getElementById('auth-status-bar').style.display = 'flex';
                document.getElementById('active-user-name').innerText = selectedMember;
                
                switchView('profile');
            } else {
                document.getElementById('auth-status-bar').style.display = 'none';
                switchView('list');
                document.getElementById('btn-confirm').disabled = false;
                document.getElementById('btn-confirm').innerText = "Vào hồ sơ";
            }
        });
    </script>
</body>
</html>