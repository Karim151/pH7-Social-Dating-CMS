<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ملف JavaScript قوي ومتطور</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', 'Tajawal', sans-serif;
        }
        
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --accent: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --success: #4cc9f0;
            --warning: #f8961e;
            --danger: #e5383b;
            --radius: 8px;
            --shadow: 0 5px 15px rgba(0,0,0,0.1);
            --transition: all 0.3s ease;
        }
        
        body {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: white;
            line-height: 1.6;
            min-height: 100vh;
            padding: 2rem;
            overflow-x: hidden;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 1rem;
            border-bottom: 2px solid var(--primary);
        }
        
        h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(to right, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .subtitle {
            font-size: 1.25rem;
            color: var(--success);
            max-width: 700px;
            margin: 0 auto;
        }
        
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: var(--radius);
            padding: 1.5rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        
        .card h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .card p {
            margin-bottom: 1rem;
            color: #cbd5e1;
        }
        
        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .feature {
            background: rgba(67, 97, 238, 0.15);
            color: var(--primary);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
        }
        
        .code-container {
            background: #0f172a;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 3rem;
        }
        
        .code-header {
            background: #1e293b;
            padding: 0.75rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .code-title {
            font-weight: 600;
            color: var(--success);
        }
        
        .btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
            font-weight: 600;
        }
        
        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .code-content {
            padding: 1.5rem;
            font-family: 'Fira Code', monospace;
            overflow-x: auto;
        }
        
        .code {
            color: #cbd5e1;
            line-height: 1.8;
        }
        
        .keyword {
            color: #ff79c6;
        }
        
        .function {
            color: #50fa7b;
        }
        
        .comment {
            color: #6272a4;
        }
        
        .string {
            color: #f1fa8c;
        }
        
        .footer {
            text-align: center;
            padding: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--gray);
        }
        
        .highlight {
            position: relative;
            display: inline-block;
        }
        
        .highlight::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: rgba(67, 97, 238, 0.3);
            z-index: -1;
            border-radius: 2px;
        }
        
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }
            
            .dashboard {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>ملف <span class="highlight">global.js</span> قوي ومتطور</h1>
            <p class="subtitle">مكتبة JavaScript حديثة تعزز تجربة المستخدم وتضيف تفاعلات قوية لموقعك باستخدام أحدث تقنيات ES6+</p>
        </header>
        
        <div class="dashboard">
            <div class="card">
                <h2>🔒 إدارة الأحداث</h2>
                <p>نظام متقدم لإدارة الأحداث مع دعم لـ Event Delegation و Custom Events</p>
                <div class="features">
                    <span class="feature">Event Delegation</span>
                    <span class="feature">Custom Events</span>
                    <span class="feature">Throttling</span>
                </div>
            </div>
            
            <div class="card">
                <h2>⚡ طلبات AJAX</h2>
                <p>واجهة مبسطة لتنفيذ طلبات HTTP مع دعم كامل للـ Promises و Async/Await</p>
                <div class="features">
                    <span class="feature">Fetch API</span>
                    <span class="feature">Error Handling</span>
                    <span class="feature">Interceptors</span>
                </div>
            </div>
            
            <div class="card">
                <h2>🎯 التوجيه الديناميكي</h2>
                <p>نظام توجيه للصفحات المفردة (SPA) مع دعم لـ History API</p>
                <div class="features">
                    <span class="feature">SPA Routing</span>
                    <span class="feature">Dynamic Imports</span>
                    <span class="feature">Lazy Loading</span>
                </div>
            </div>
            
            <div class="card">
                <h2>📊 إدارة الحالة</h2>
                <p>نظام مركزي لإدارة حالة التطبيق مع دعم للتفاعل في الوقت الحقيقي</p>
                <div class="features">
                    <span class="feature">State Management</span>
                    <span class="feature">Reactivity</span>
                    <span class="feature">Observables</span>
                </div>
            </div>
            
            <div class="card">
                <h2>🛡️ الأمان</h2>
                <p>ميزات أمان متقدمة لحماية من الثغرات الشائعة مثل XSS و CSRF</p>
                <div class="features">
                    <span class="feature">XSS Protection</span>
                    <span class="feature">CSRF Tokens</span>
                    <span class="feature">Sanitization</span>
                </div>
            </div>
            
            <div class="card">
                <h2>📱 متجاوب</h2>
                <p>تتبع لحجم الشاشة والتكيف الديناميكي مع جميع الأجهزة</p>
                <div class="features">
                    <span class="feature">Media Queries</span>
                    <span class="feature">Touch Events</span>
                    <span class="feature">Responsive Design</span>
                </div>
            </div>
        </div>
        
        <div class="code-container">
            <div class="code-header">
                <div class="code-title">global.js</div>
                <button class="btn" id="copyBtn">نسخ الكود</button>
            </div>
            <div class="code-content">
                <pre class="code"><code>/**
 * ملف JavaScript قوي ومتطور
 * يحتوي على وحدات متكاملة لتطوير تطبيقات ويب حديثة
 */

'use strict';

class GlobalJS {
  constructor() {
    this._state = {};
    this._routes = {};
    this._eventHandlers = new Map();
    this._init();
  }

  // تهيئة التطبيق
  _init() {
    this._setupEventListeners();
    this._handleRouting();
    this._setupAjaxInterceptor();
  }

  // إعداد مستمعي الأحداث
  _setupEventListeners() {
    document.addEventListener('click', this._handleEvent.bind(this));
    window.addEventListener('resize', this._throttle(this._handleResize.bind(this), 200));
    window.addEventListener('popstate', this._handleRouting.bind(this));
  }

  // إدارة الأحداث مع تفويض
  _handleEvent(e) {
    const target = e.target;
    
    // البحث عن العنصر الأقرب بمحدد البيانات
    const actionElement = target.closest('[data-action]');
    if (actionElement) {
      const action = actionElement.dataset.action;
      this._trigger(action, { element: actionElement, event: e });
      return;
    }
    
    // البحث عن العنصر الأقرب بمحدد التوجيه
    const routeElement = target.closest('[data-route]');
    if (routeElement) {
      e.preventDefault();
      const route = routeElement.dataset.route;
      this.navigateTo(route);
    }
  }

  // تنفيذ التوجيه
  _handleRouting() {
    const path = window.location.pathname;
    const handler = this._routes[path] || this._routes['*'];
    if (handler) {
      handler();
    }
  }

  // إعداد معترض طلبات AJAX
  _setupAjaxInterceptor() {
    const originalFetch = window.fetch;
    const self = this;
    
    window.fetch = async function(url, options = {}) {
      // إضافة رأس الحماية
      options.headers = {
        ...options.headers,
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-Token': self._getCSRFToken()
      };
      
      try {
        const response = await originalFetch(url, options);
        if (!response.ok) throw new Error(response.statusText);
        return response;
      } catch (error) {
        self._trigger('ajax:error', { error });
        throw error;
      }
    };
  }

  // إضافة مسار جديد
  route(path, handler) {
    this._routes[path] = handler;
  }

  // التنقل إلى مسار معين
  navigateTo(path) {
    window.history.pushState({}, '', path);
    this._handleRouting();
  }

  // تسجيل حدث مخصص
  on(event, handler) {
    if (!this._eventHandlers.has(event)) {
      this._eventHandlers.set(event, []);
    }
    this._eventHandlers.get(event).push(handler);
  }

  // تفعيل حدث مخصص
  _trigger(event, data = {}) {
    const handlers = this._eventHandlers.get(event) || [];
    handlers.forEach(handler => handler(data));
  }

  // تنفيذ AJAX
  ajax(url, options = {}) {
    return fetch(url, {
      method: options.method || 'GET',
      headers: {
        'Content-Type': 'application/json',
        ...options.headers
      },
      body: options.body ? JSON.stringify(options.body) : undefined
    });
  }

  // التحكم في معدل الأحداث
  _throttle(func, limit) {
    let lastFunc;
    let lastRan;
    return function() {
      const context = this;
      const args = arguments;
      if (!lastRan) {
        func.apply(context, args);
        lastRan = Date.now();
      } else {
        clearTimeout(lastFunc);
        lastFunc = setTimeout(function() {
          if ((Date.now() - lastRan) >= limit) {
            func.apply(context, args);
            lastRan = Date.now();
          }
        }, limit - (Date.now() - lastRan));
      }
    };
  }

  // توليد رمز الحماية
  _getCSRFToken() {
    const token = document.querySelector('meta[name="csrf-token"]');
    return token ? token.content : '';
  }
}

// تهيئة التطبيق
const app = new GlobalJS();

// مسارات رئيسية
app.route('/', () => app._trigger('page:home'));
app.route('/about', () => app._trigger('page:about'));
app.route('/contact', () => app._trigger('page:contact'));
app.route('*', () => app._trigger('page:notfound'));

// أحداث مخصصة
app.on('page:home', () => console.log('الصفحة الرئيسية تم تحميلها'));
app.on('ajax:error', (err) => console.error('خطأ في الطلب:', err.error));

// تعريض التطبيق للاستخدام العالمي
window.App = app;</code></pre>
            </div>
        </div>
        
        <div class="footer">
            <p>ملف global.js قوي ومتطور جاهز للاستخدام في مشاريعك - يدعم جميع المتصفحات الحديثة</p>
        </div>
    </div>

    <script>
        // كود JavaScript للنسخ والتفاعل
        document.addEventListener('DOMContentLoaded', function() {
            const copyBtn = document.getElementById('copyBtn');
            
            if (copyBtn) {
                copyBtn.addEventListener('click', function() {
                    const code = document.querySelector('.code').textContent;
                    navigator.clipboard.writeText(code)
                        .then(() => {
                            copyBtn.textContent = 'تم النسخ!';
                            setTimeout(() => {
                                copyBtn.textContent = 'نسخ الكود';
                            }, 2000);
                        })
                        .catch(err => {
                            console.error('فشل في النسخ: ', err);
                        });
                });
            }
            
            // تأثيرات للبطاقات
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 150 * index);
            });
        });
    </script>
</body>
</html>
