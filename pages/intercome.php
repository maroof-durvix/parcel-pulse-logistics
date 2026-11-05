<?php include('../includes/header.php'); ?>

<style>
.term-card {
    background: rgba(6, 11, 20, 0.85);
    border: 1px solid rgba(0, 242, 254, 0.2);
    border-radius: var(--radius-md);
    padding: 16px 20px;
    transition: var(--transition);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.term-card:hover, .term-card.active {
    border-color: var(--cyan);
    background: rgba(0, 242, 254, 0.1);
    box-shadow: 0 0 15px rgba(0, 242, 254, 0.25);
    transform: translateX(4px);
}

.ai-explainer-box {
    background: rgba(6, 11, 20, 0.9);
    border: 1px solid var(--cyan);
    border-radius: var(--radius-md);
    padding: 28px;
    box-shadow: 0 0 25px rgba(0, 242, 254, 0.15);
    position: relative;
}

.quiz-option {
    background: rgba(6, 11, 20, 0.85);
    border: 1px solid rgba(0, 242, 254, 0.2);
    color: var(--text-secondary);
    padding: 14px 20px;
    border-radius: var(--radius-md);
    width: 100%;
    text-align: left;
    margin-bottom: 12px;
    transition: var(--transition);
    cursor: pointer;
    font-size: 0.95rem;
}
.quiz-option:hover {
    border-color: var(--cyan);
    color: #fff;
    background: rgba(0, 242, 254, 0.1);
}
.quiz-option.correct {
    background: rgba(16, 185, 129, 0.2);
    border-color: #10b981;
    color: #86efac;
}
.quiz-option.wrong {
    background: rgba(239, 68, 68, 0.2);
    border-color: #ef4444;
    color: #fca5a5;
}
</style>

<!-- HERO -->
<section class="page-hero hero-intercom">
    <div class="container text-center">
        <span class="badge-cyan mb-2 d-inline-block"><i class="fa-solid fa-graduation-cap me-1"></i> International Commercial Standards</span>
        <h1 class="hero-title-gradient">Incoterms Trade Hub</h1>
        <p class="text-secondary max-w-lg mx-auto" style="max-width: 650px;">
            Navigate international ICC rules, seller vs. buyer liabilities, and risk transfer points powered by the Pulse AI Trade Explainer.
        </p>
    </div>
</section>

<!-- INCOTERMS INTERACTIVE EXPLAINER -->
<section class="py-5" style="background: var(--bg-main);">
    <div class="container">
        <div class="row g-4 mb-5">
            <!-- Term Selector Column -->
            <div class="col-lg-4">
                <div class="pulse-card">
                    <h5 class="fw-bold text-white mb-3">
                        <i class="fa-solid fa-list-check text-info me-2"></i> Select Rule (ICC 2020)
                    </h5>
                    <div class="d-flex flex-column gap-2" id="termsList">
                        <div class="term-card active" onclick="explainTerm('EXW', this)">
                            <div>
                                <h6 class="text-white fw-bold mb-0">EXW</h6>
                                <small class="text-secondary">Ex Works (Origin Facility)</small>
                            </div>
                            <i class="fa-solid fa-chevron-right text-info"></i>
                        </div>
                        <div class="term-card" onclick="explainTerm('FOB', this)">
                            <div>
                                <h6 class="text-white fw-bold mb-0">FOB</h6>
                                <small class="text-secondary">Free On Board (Port Vessel)</small>
                            </div>
                            <i class="fa-solid fa-chevron-right text-info"></i>
                        </div>
                        <div class="term-card" onclick="explainTerm('CIF', this)">
                            <div>
                                <h6 class="text-white fw-bold mb-0">CIF</h6>
                                <small class="text-secondary">Cost, Insurance & Freight</small>
                            </div>
                            <i class="fa-solid fa-chevron-right text-info"></i>
                        </div>
                        <div class="term-card" onclick="explainTerm('DDP', this)">
                            <div>
                                <h6 class="text-white fw-bold mb-0">DDP</h6>
                                <small class="text-secondary">Delivered Duty Paid (Maximum Seller)</small>
                            </div>
                            <i class="fa-solid fa-chevron-right text-info"></i>
                        </div>
                        <div class="term-card" onclick="explainTerm('FCA', this)">
                            <div>
                                <h6 class="text-white fw-bold mb-0">FCA</h6>
                                <small class="text-secondary">Free Carrier (Named Place)</small>
                            </div>
                            <i class="fa-solid fa-chevron-right text-info"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- AI Explainer Content Column -->
            <div class="col-lg-8">
                <div class="pulse-card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-brain text-info fs-5"></i>
                            <h4 class="fw-bold text-white mb-0" id="termTitle">EXW — Ex Works</h4>
                        </div>
                        <span class="badge-cyan small">ICC Standards</span>
                    </div>

                    <div class="ai-explainer-box mb-4">
                        <p class="text-light mb-3" id="termSummary" style="line-height: 1.8;">
                            Under <strong>EXW (Ex Works)</strong>, the seller fulfills their obligation when goods are placed at the disposal of the buyer at the seller's premises. The buyer bears all risks and costs from the seller's door to the final destination.
                        </p>

                        <div class="row g-3 pt-3 border-top border-secondary border-opacity-25 small">
                            <div class="col-md-6">
                                <span class="text-secondary"><i class="fa-solid fa-user-tie text-info me-1"></i> Seller Responsibility:</span>
                                <div class="text-white mt-1" id="sellerDuty">Packaging & making goods available for pickup.</div>
                            </div>
                            <div class="col-md-6">
                                <span class="text-secondary"><i class="fa-solid fa-cart-shopping text-warning me-1"></i> Buyer Responsibility:</span>
                                <div class="text-white mt-1" id="buyerDuty">Export customs, main transport carriage, insurance, and import clearance.</div>
                            </div>
                            <div class="col-12 mt-3">
                                <span class="text-secondary"><i class="fa-solid fa-triangle-exclamation text-danger me-1"></i> Critical Risk Transfer Point:</span>
                                <div class="text-info mt-1" id="riskPoint">At the seller's factory/warehouse before loading onto collecting vehicle.</div>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded-3 small" style="background: rgba(0, 242, 254, 0.05); border: 1px solid rgba(0, 242, 254, 0.2);">
                        <i class="fa-solid fa-lightbulb text-info me-2"></i>
                        <span id="aiInsight">Pro Tip: If you are an international buyer without local export agents, avoid EXW; prefer FCA or FOB instead.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Interactive Incoterms Quiz -->
        <div class="row">
            <div class="col-12">
                <div class="pulse-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-circle-question text-warning fs-5"></i>
                            <h4 class="fw-bold text-white mb-0">Global Trade Knowledge Check</h4>
                        </div>
                        <span class="badge bg-warning text-dark fw-bold">Interactive Test</span>
                    </div>

                    <div class="p-4 rounded-3" style="background: rgba(6, 11, 20, 0.85); border: 1px solid rgba(255,255,255,0.06);">
                        <h6 class="text-white mb-3" id="quizQuestion">
                            Which Incoterm places the MAXIMUM responsibility, import customs duties, and delivery risk on the SELLER?
                        </h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="quiz-option" onclick="checkQuiz(this, false)">A) EXW (Ex Works)</div>
                            </div>
                            <div class="col-md-6">
                                <div class="quiz-option" onclick="checkQuiz(this, false)">B) FOB (Free on Board)</div>
                            </div>
                            <div class="col-md-6">
                                <div class="quiz-option" onclick="checkQuiz(this, true)">C) DDP (Delivered Duty Paid)</div>
                            </div>
                            <div class="col-md-6">
                                <div class="quiz-option" onclick="checkQuiz(this, false)">D) CIF (Cost, Insurance & Freight)</div>
                            </div>
                        </div>
                        <div id="quizFeedback" class="mt-3 small" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
const termData = {
    'EXW': {
        title: 'EXW — Ex Works',
        summary: 'Under <strong>EXW (Ex Works)</strong>, the seller fulfills their obligation when goods are made available at their facility. The buyer assumes 100% of the transportation costs, risks, and customs formalities.',
        seller: 'Product manufacture, packaging, and marking.',
        buyer: 'Collection, export clearance, ocean/air carriage, import duties.',
        risk: 'At the seller factory before loading.',
        insight: 'Best suited for domestic commerce; international buyers should prefer FCA.'
    },
    'FOB': {
        title: 'FOB — Free On Board',
        summary: 'Under <strong>FOB (Free On Board)</strong>, the seller is responsible for export clearance and loading goods onto the vessel nominated by the buyer at the origin port.',
        seller: 'Inland transport, origin terminal handling, export customs, vessel loading.',
        buyer: 'Ocean freight, marine cargo insurance, destination import duties & delivery.',
        risk: 'Once goods are safely loaded on board the vessel at origin port.',
        insight: 'Standard default for ocean container trade between China, Pakistan, and UAE.'
    },
    'CIF': {
        title: 'CIF — Cost, Insurance and Freight',
        summary: 'Under <strong>CIF</strong>, the seller pays for the carriage of goods to the named port of destination AND provides minimum marine cargo insurance coverage.',
        seller: 'Export clearance, ocean freight payment, and cargo insurance policy.',
        buyer: 'Destination port discharge, import customs duties, and inland transit.',
        risk: 'Transfers when goods are placed on board at origin port (even though seller pays freight).',
        insight: 'Seller is obligated to procure insurance complying with Institute Cargo Clauses (C).'
    },
    'DDP': {
        title: 'DDP — Delivered Duty Paid',
        summary: 'Under <strong>DDP</strong>, the seller bears all risks and costs to deliver the goods cleared for import at the buyer named place, including all taxes and duties.',
        seller: '100% of all operations: freight, export/import clearance, destination taxes, last-mile drop.',
        buyer: 'Unloading at destination facility.',
        risk: 'At the buyer destination doorstep upon arrival.',
        insight: 'E-commerce gold standard for frictionless end-user experience.'
    },
    'FCA': {
        title: 'FCA — Free Carrier',
        summary: 'Under <strong>FCA</strong>, the seller delivers the goods, cleared for export, to the carrier nominated by the buyer at the seller premises or another named place.',
        seller: 'Export clearance, delivery to nominated forwarder/terminal.',
        buyer: 'Main transit carriage, insurance, and import clearance.',
        risk: 'When handed over to the nominated carrier.',
        insight: 'Highly recommended modern alternative to EXW for containerized and multi-modal shipments.'
    }
};

function explainTerm(code, element) {
    document.querySelectorAll('.term-card').forEach(c => c.classList.remove('active'));
    element.classList.add('active');

    const data = termData[code];
    if (!data) return;

    document.getElementById('termTitle').innerHTML = data.title;
    document.getElementById('termSummary').innerHTML = data.summary;
    document.getElementById('sellerDuty').innerText = data.seller;
    document.getElementById('buyerDuty').innerText = data.buyer;
    document.getElementById('riskPoint').innerText = data.risk;
    document.getElementById('aiInsight').innerText = 'Pro Tip: ' + data.insight;
}

function checkQuiz(btn, isCorrect) {
    const feedback = document.getElementById('quizFeedback');
    document.querySelectorAll('.quiz-option').forEach(opt => {
        opt.classList.remove('correct', 'wrong');
    });

    if (isCorrect) {
        btn.classList.add('correct');
        feedback.className = 'mt-3 small text-success fw-bold';
        feedback.innerHTML = '<i class="fa-solid fa-circle-check me-1"></i> Correct! Under DDP (Delivered Duty Paid), the seller handles all export, import, customs duties, and last-mile delivery.';
    } else {
        btn.classList.add('wrong');
        feedback.className = 'mt-3 small text-danger fw-bold';
        feedback.innerHTML = '<i class="fa-solid fa-circle-xmark me-1"></i> Incorrect. Review DDP (Delivered Duty Paid) where the seller carries maximum responsibility.';
    }
    feedback.style.display = 'block';
}
</script>

<?php include('../includes/footer.php'); ?>
