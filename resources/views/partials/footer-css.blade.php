<style>
    /* Sticky Footer - always at bottom */
    html { height: 100%; }
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
    }
    body > * {
        flex-shrink: 0;
    }
    body > main,
    body > .main-container,
    body > .container {
        flex: 1 0 auto;
    }
    body > .footer {
        flex-shrink: 0;
        margin-top: auto;
    }

    .footer {
        background: linear-gradient(135deg, var(--navy-color), var(--navy-light));
        padding: 50px 20px 30px;
        color: white;
    }

    .footer-content {
        max-width: 1500px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 40px;
        margin-bottom: 35px;
    }

    .footer-brand h3 {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--gold-color);
        margin-bottom: 12px;
        letter-spacing: 1px;
    }

    .footer-brand p {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.6);
        line-height: 1.6;
        max-width: 300px;
    }

    .footer-links h4 {
        font-size: 0.95rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--gold-color);
    }

    .footer-links ul {
        list-style: none;
    }

    .footer-links li {
        margin-bottom: 8px;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        font-size: 0.85rem;
        transition: var(--transition);
    }

    .footer-links a:hover {
        color: var(--gold-color);
        padding-left: 5px;
    }

    .footer-social {
        display: flex;
        gap: 12px;
        margin-top: 20px;
    }

    .footer-social a {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.2);
        display: flex;
        justify-content: center;
        align-items: center;
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        transition: var(--transition);
        cursor: default; /* Make inactive */
    }

    .footer-bottom {
        text-align: center;
        padding-top: 25px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 0.82rem;
        color: rgba(255, 255, 255, 0.4);
    }

    @media (max-width: 768px) {
        .footer-content {
            grid-template-columns: 1fr;
            gap: 30px;
            text-align: center;
        }

        .footer-brand p {
            max-width: 100%;
            margin: 0 auto;
        }

        .footer-social {
            justify-content: center;
        }
    }
</style>
