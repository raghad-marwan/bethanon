/* ========== القائمة الجانبية ========== */
document.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.getElementById("hamburger-btn");
  const navMenu = document.querySelector(".nav-menu");
  const navbar = document.querySelector(".navbar");

  if (hamburger) {
    hamburger.addEventListener("click", () => {
      hamburger.classList.toggle("active");
      navMenu.classList.toggle("active");
    });
  }

  document.querySelectorAll(".nav-link").forEach(link => {
    link.addEventListener("click", () => {
      hamburger.classList.remove("active");
      navMenu.classList.remove("active");
    });
  });

  window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });
});

/* ========== ظهور البطاقات ========== */
document.addEventListener("DOMContentLoaded", () => {
  const fadeCards = document.querySelectorAll(".hidden-card");

  const cardObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show-card");
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.2 });

  fadeCards.forEach(card => {
    cardObserver.observe(card);
  });
});

/* ========== عدادات الأرقام ========== */
document.addEventListener("DOMContentLoaded", () => {
  const statNumbers = document.querySelectorAll(".stat-number");

  const animateCounter = (element) => {
    const target = +element.getAttribute("data-target");
    const duration = 2000;
    const startTime = performance.now();

    const updateNumber = (currentTime) => {
      const elapsedTime = currentTime - startTime;
      const progress = Math.min(elapsedTime / duration, 1);
      const easeOutProgress = 1 - Math.pow(1 - progress, 3);
      const currentValue = Math.floor(easeOutProgress * target);

      element.innerText = currentValue.toLocaleString("en-US");

      if (progress < 1) {
        requestAnimationFrame(updateNumber);
      } else {
        element.innerText = target.toLocaleString("en-US");
      }
    };

    requestAnimationFrame(updateNumber);
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        statNumbers.forEach(num => animateCounter(num));
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.2 });

  const targetSection = document.querySelector(".about-section");
  if (targetSection) observer.observe(targetSection);
});

/* ========== عدادات Dashboard ========== */
document.addEventListener("DOMContentLoaded", () => {
  const counters = document.querySelectorAll(".counter");

  const startCounter = (counter) => {
    const updateCount = () => {
      const target = +counter.getAttribute("data-target");
      const count = +counter.innerText.replace(/,/g, "");
      const inc = Math.ceil(target / 60);

      if (count < target) {
        counter.innerText = (count + inc).toLocaleString("en-US");
        setTimeout(updateCount, 20);
      } else {
        counter.innerText = target.toLocaleString("en-US");
      }
    };
    updateCount();
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        startCounter(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(counter => observer.observe(counter));
});

/* ========== مودال التبرع - يرسل للباك إند ========== */
function openDonationModal() {
  document.getElementById('donationModal').classList.add('show');
}

function closeDonationModal() {
  document.getElementById('donationModal').classList.remove('show');
}

async function executeDonation() {
  const donorName = document.getElementById('modalDonorName').value.trim();
  const amount = document.getElementById('modalAmount').value.trim();
  const anonymous = document.getElementById('modalAnonCheck').checked;

  if (!amount) {
    alert("يرجى إدخال قيمة التبرع");
    return;
  }

  const finalName = (anonymous || donorName === "") ? "فاعل خير" : donorName;
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

  try {
    const response = await fetch('/donations', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({
        donor_name: finalName,
        amount: parseFloat(amount),
        anonymous: anonymous || donorName === ""
      })
    });

    if (response.ok) {
      const data = await response.json();
      alert(data.message);
      closeDonationModal();
      location.reload();
    } else {
      alert("حدث خطأ، تأكد من البيانات المدخلة");
    }
  } catch (error) {
    console.error("Error:", error);
    alert("حدث خطأ في الاتصال، حاول مرة أخرى");
  }
}
// إغلاق المودال عند الضغط خارجه
document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById('donationModal');
  if (modal) {
    modal.addEventListener('click', function(e) {
      if (e.target === this) {
        closeDonationModal();
      }
    });
  }
});

