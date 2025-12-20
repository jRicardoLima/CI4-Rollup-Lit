# CI4 + Lit + Rollup

A clean and opinionated integration of **Lit + Rollup + TypeScript** for **CodeIgniter 4.6+** projects.

This package provides a modern frontend workflow **without introducing SPA complexity**, keeping full control over the build and production output.

---

## ✨ Features

- ⚡ Rollup preconfigured out of the box  
- 🧩 Lit (Web Components) with TypeScript  
- 📦 Automatic manifest generation (cache busting)  
- 🛠️ `spark` commands for init, build and dev  
- 🧠 Native CI4 helper: `frontend_script()`  
- 🚫 No Node.js running in production  

---

## 📦 Installation

Install via Composer and initialize the frontend:

```bash
composer require jricardolima/ci4-lit-rollup
php spark frontend:init
php spark frontend:install
php spark frontend:build
php spark frontend:dev
```

🤔 **Why not Vite?**

Vite is great — for SPAs.

This package intentionally avoids Vite because:

- Most CI4 projects are server-rendered, not SPAs

- Running a dev server + HMR is unnecessary overhead

- Production does not need Node.js at all

- Rollup gives full control over output structure

- Manifest-based loading is predictable and stable

- Fewer abstractions, fewer surprises

If you need a full SPA, Vite is an excellent choice.
If you want modern JavaScript without turning your CI4 app into a SPA, this package is built for you.

📌 **Design philosophy**

- Build happens only in development

- Production serves static assets only

- No framework lock-in

- Explicit over magic

**Ideal for**:

- ERPs

- Internal systems

- CI4-based SaaS

- Projects that want modern frontend without SPA complexity

🧩 **Why Lit?**

Lit is a modern library built on top of **Web Components**, not a framework that replaces the platform.

It was chosen for this package because it is:

- **Standards-based**  
  Built directly on Web Components, Custom Elements and Shadow DOM.

- **Lightweight**  
  Minimal runtime, fast startup, small bundles.

- **Framework-agnostic**  
  Works perfectly with server-rendered applications like CI4.

- **Simple by design**  
  Low API surface, easy to reason about, no complex lifecycle.

- **Future-proof**  
  Web Components are a browser standard, not a transient abstraction.

Lit allows you to build reusable UI components **without turning your application into a SPA**, making it a natural fit for CodeIgniter-based projects.

🧩 **Enabling the Helper**

After installing and running frontend:init, you must load the helper so CodeIgniter can resolve frontend_script().

The recommended approach is to load it globally in your BaseController:

```
namespace App\Controllers;

use CodeIgniter\Controller;

class BaseController extends Controller
{
     public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        $this->helpers = ['form', 'url','frontend'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        // $this->session = service('session');
    }
}
```

🖼️ **Loading the frontend assets in views**

```
<?= frontend_script() ?>
```

✅ Best practice:
Place this call in your main layout view (for example app/Views/layouts/default.php), so all child views automatically load the frontend assets.

📄 **License**

MIT
