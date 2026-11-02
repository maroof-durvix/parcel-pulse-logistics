<?php include('../includes/header.php'); ?>

<style>
/* AI Intercome/Incoterms Styles */
.incoterms-hero {
    position: relative;
    padding: 120px 0 60px;
    background: url('../assets/img/services_hero.png') no-repeat center center/cover;
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
    min-height: 100vh;
}
.incoterms-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(180deg, rgba(10,14,23,0.85) 0%, rgba(10,14,23,1) 100%);
}
.content-layer {
    position: relative;
    z-index: 2;
}
.term-card {
    background: rgba(20, 25, 40, 0.6);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(0, 255, 255, 0.2);
    border-radius: 15px;
    padding: 25px;
    transition: 0.3s;
    cursor: pointer;
    height: 100%;
}
.term-card:hover, .term-card.active {
    border-color: #00ffff;
    box-shadow: 0 0 20px rgba(0,255,255,0.2);
    transform: translateY(-5px);
}
.ai-explainer-box {
    background: rgba(0,0,0,0.5);
    border: 1px solid #00ffff;
    border-radius: 15px;
    padding: 30px;
    position: relative;
}
.ai-explainer-box::after {
    content: 'AI Generated Explanation';
    position: absolute;
    top: -12px;
    right: 20px;
    background: #081120;
    color: #00ffff;
    padding: 0 10px;
    font-size: 0.8rem;
    border: 1px solid #00ffff;
    border-radius: 10px;
}
.quiz-section {
    background: linear-gradient(135deg, rgba(20, 25, 40, 0.8), rgba(0, 191, 255, 0.1));
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 20px;
    padding: 40px;
    margin-top: 40px;
}
.quiz-btn {
    background: transparent;
    border: 1px solid rgba(255,255,255,0.2);
    color: white;
    padding: 10px 20px;
    border-radius: 10px;
    width: 100%;
    text-align: left;
    margin-bottom: 10px;
    transition: 0.3s;
}
.quiz-btn:hover {
    border-color: #00ffff;
    background: rgba(0,255,255,0.1);
}
.quiz-btn.correct { background: rgba(40,167,69,0.2); border-color: #28a745; }
.quiz-btn.wrong { background: rgba(220,53,69,0.2); border-color: #dc3545; }
</style>

<div class="incoterms-hero text-light">
    <div class="container content-layer">
        
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold"><i class="fa-solid fa-book-atlas text-info"></i> AI Incoterms Learning</h1>
            <p class="lead text-muted">Master international shipping terms with our AI Explainer Mode.</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-4">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="term-card active" onclick="explainTerm('EXW')">
                            <h5 class="text-info fw-bold mb-0">EXW <small class="text-muted" style="font-size:0.7rem;">Ex Works</small></h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="term-card" onclick="explainTerm('FCA')">
                            <h5 class="text-info fw-bold mb-0">FCA <small class="text-muted" style="font-size:0.7rem;">Free Carrier</small></h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="term-card" onclick="explainTerm('CPT')">
                            <h5 class="text-info fw-bold mb-0">CPT <small class="text-muted" style="font-size:0.7rem;">Carriage Paid To</small></h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="term-card" onclick="explainTerm('CIP')">
                            <h5 class="text-info fw-bold mb-0">CIP <small class="text-muted" style="font-size:0.7rem;">Carriage and Insurance Paid To</small></h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="term-card" onclick="explainTerm('DAT')">
                            <h5 class="text-info fw-bold mb-0">DAT <small class="text-muted" style="font-size:0.7rem;">Delivered at Terminal</small></h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="term-card" onclick="explainTerm('DAP')">
                            <h5 class="text-info fw-bold mb-0">DAP <small class="text-muted" style="font-size:0.7rem;">Delivered at Place</small></h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="term-card" onclick="explainTerm('DDP')">
                            <h5 class="text-info fw-bold mb-0">DDP <small class="text-muted" style="font-size:0.7rem;">Delivered Duty Paid</small></h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="term-card" onclick="explainTerm('FAS')">
                            <h5 class="text-info fw-bold mb-0">FAS <small class="text-muted" style="font-size:0.7rem;">Free Alongside Ship</small></h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="term-card" onclick="explainTerm('FOB')">
                            <h5 class="text-info fw-bold mb-0">FOB <small class="text-muted" style="font-size:0.7rem;">Free On Board</small></h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="term-card" onclick="explainTerm('CFR')">
                            <h5 class="text-info fw-bold mb-0">CFR <small class="text-muted" style="font-size:0.7rem;">Cost and Freight</small></h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="term-card" onclick="explainTerm('CIF')">
                            <h5 class="text-info fw-bold mb-0">CIF <small class="text-muted" style="font-size:0.7rem;">Cost, Insurance and Freight</small></h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="ai-explainer-box h-100">
                    <h3 id="term-title" class="fw-bold text-light mb-3">FOB (Free On Board)</h3>
                    <div id="term-content">
                        <p><strong>Simple English:</strong> The seller pays for transportation of the goods to the port of shipment, plus loading costs. The buyer pays cost of marine freight transport, insurance, unloading, and transportation from the arrival port to the final destination.</p>
                        <hr class="border-secondary">
                        <p><strong>Urdu Summary:</strong> Seller ki zimmedari tab khatam hoti hai jab saman ship (jahaz) par load ho jaye. Uske baad ka sara kharcha aur risk buyer ka hota hai.</p>
                        <div class="mt-4 p-3 rounded" style="background: rgba(0,255,255,0.05); border: 1px dashed rgba(0,255,255,0.3);">
                            <h6 class="text-info"><i class="fa-solid fa-code-compare"></i> Compare Mode: FOB vs CIF</h6>
                            <p class="small mb-0 text-muted">In <strong>FOB</strong>, buyer buys insurance. In <strong>CIF</strong>, seller must pay for insurance during transit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- AI Quiz Section -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="quiz-section text-center">
                    <h3 class="mb-4"><i class="fa-solid fa-gamepad text-info"></i> Test Your Knowledge</h3>
                    <div id="quiz-container">
                        <h5 class="mb-4">"If the goods get damaged while the ship is crossing the ocean under FOB terms, who bears the loss?"</h5>
                        <div class="row">
                            <div class="col-md-6"><button class="quiz-btn" onclick="checkAns(this, false)">A) The Seller</button></div>
                            <div class="col-md-6"><button class="quiz-btn" onclick="checkAns(this, true)">B) The Buyer</button></div>
                            <div class="col-md-6"><button class="quiz-btn" onclick="checkAns(this, false)">C) The Shipping Company</button></div>
                            <div class="col-md-6"><button class="quiz-btn" onclick="checkAns(this, false)">D) Both equally</button></div>
                        </div>
                        <p id="quiz-feedback" class="mt-3 fw-bold"></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
const termData = {
    'EXW': {
        title: 'EXW (Ex Works)',
        eng: 'The seller makes the goods available at their premises. The buyer incurs the risks for bringing the goods to their final destination.',
        urdu: 'Seller bas apna saman factory mein ready rakhta hai. Factory se uthana aur apne mulk tak le jana sab buyer ki headache hai.',
        comp: '<strong>EXW</strong> represents minimum obligation for the seller, whereas CIF/FOB require seller to handle export clearances and local transport.'
    },
    'FCA': {
        title: 'FCA (Free Carrier)',
        eng: 'The seller delivers the goods, cleared for export, to the carrier nominated by the buyer at the named place.',
        urdu: 'Seller saman ko export clearance ke baad buyer ke bataye hue transporter (carrier) ke hawale kar deta hai.',
        comp: 'Unlike EXW, <strong>FCA</strong> requires the seller to handle export customs clearance.'
    },
    'CPT': {
        title: 'CPT (Carriage Paid To)',
        eng: 'The seller pays for the carriage of the goods up to the named place of destination. Risk transfers when goods are handed to the first carrier.',
        urdu: 'Seller saman ko destination tak pohanchane ka kiraya deta hai, lekin raste ka risk buyer ka hota hai.',
        comp: 'In <strong>CPT</strong> the seller pays for freight, but unlike CIP, does not have to pay for insurance.'
    },
    'CIP': {
        title: 'CIP (Carriage and Insurance Paid To)',
        eng: 'Similar to CPT, but the seller is also required to procure insurance against the buyer’s risk of loss or damage to the goods during the carriage.',
        urdu: 'Seller kiraye ke sath sath raste ki insurance ka kharcha bhi uthata hai.',
        comp: '<strong>CIP</strong> requires the seller to provide insurance, whereas CPT does not.'
    },
    'DAT': {
        title: 'DAT (Delivered at Terminal)',
        eng: 'The seller delivers when the goods, once unloaded from the arriving means of transport, are placed at the disposal of the buyer at a named terminal.',
        urdu: 'Seller saman ko destination terminal par unload karwa ke buyer ke hawale karta hai.',
        comp: 'In <strong>DAT</strong> the seller is responsible for unloading, whereas in DAP the buyer unloads.'
    },
    'DAP': {
        title: 'DAP (Delivered at Place)',
        eng: 'The seller delivers when the goods are placed at the disposal of the buyer on the arriving means of transport ready for unloading at the named place.',
        urdu: 'Seller saman buyer ki jagah tak pohnchata hai, lekin truck se utarne (unloading) ki zimmedari buyer ki hoti hai.',
        comp: 'In <strong>DAP</strong> the buyer is responsible for unloading, whereas in DAT the seller unloads.'
    },
    'DDP': {
        title: 'DDP (Delivered Duty Paid)',
        eng: 'The seller is responsible for delivering the goods to the named place in the country of the buyer, and pays all costs in bringing the goods to the destination including import duties and taxes.',
        urdu: 'Seller ki maximum zimmedari hoti hai. Saman pohnchana, tax aur import duty sab seller bharta hai.',
        comp: '<strong>DDP</strong> is the maximum obligation for the seller, completely opposite to EXW.'
    },
    'FAS': {
        title: 'FAS (Free Alongside Ship)',
        eng: 'The seller delivers when the goods are placed alongside the vessel (e.g., on a quay or a barge) nominated by the buyer at the named port of shipment.',
        urdu: 'Seller saman ko port par jahaz ke bilkul sath la kar rakh deta hai. Jahaz par charhana buyer ka kaam hai.',
        comp: 'In <strong>FAS</strong>, the buyer must load the goods onto the ship, while in FOB the seller loads them.'
    },
    'FOB': {
        title: 'FOB (Free On Board)',
        eng: 'The seller pays for transportation of the goods to the port of shipment, plus loading costs. The buyer pays cost of marine freight transport, insurance, unloading, and transportation from the arrival port to the final destination.',
        urdu: 'Seller ki zimmedari tab khatam hoti hai jab saman ship (jahaz) par load ho jaye. Uske baad ka sara kharcha aur risk buyer ka hota hai.',
        comp: 'In <strong>FOB</strong>, buyer buys insurance. In <strong>CIF</strong>, seller must pay for insurance during transit.'
    },
    'CFR': {
        title: 'CFR (Cost and Freight)',
        eng: 'The seller pays for the carriage of the goods up to the named port of destination. Risk transfers to buyer when the goods have been loaded on board the vessel in the country of Export.',
        urdu: 'Seller destination port tak jahaz ka kiraya deta hai, lekin saman jahaz par load hone ke baad risk buyer ka ho jata hai.',
        comp: '<strong>CFR</strong> requires the seller to pay freight, but unlike CIF, does not require the seller to pay for insurance.'
    },
    'CIF': {
        title: 'CIF (Cost, Insurance and Freight)',
        eng: 'The seller is responsible for the cost and freight of bringing the goods to the destination port specified by the buyer, including insurance during the sea transit.',
        urdu: 'Seller saman ko buyer ki country ke port tak pohnchane aur raste ki insurance ka kharcha uthata hai. Port par pohnchne ke baad ka risk buyer ka hai.',
        comp: 'Unlike FOB, <strong>CIF</strong> requires the seller to provide maritime insurance for the goods.'
    }
};

function explainTerm(term) {
    // UI toggle active
    document.querySelectorAll('.term-card').forEach(c => c.classList.remove('active'));
    event.currentTarget.classList.add('active');

    // Update Content with AI "typing" feel
    const box = document.getElementById('term-content');
    box.style.opacity = '0.3';
    
    setTimeout(() => {
        document.getElementById('term-title').innerText = termData[term].title;
        box.innerHTML = `
            <p><strong>Simple English:</strong> ${termData[term].eng}</p>
            <hr class="border-secondary">
            <p><strong>Urdu Summary:</strong> ${termData[term].urdu}</p>
            <div class="mt-4 p-3 rounded" style="background: rgba(0,255,255,0.05); border: 1px dashed rgba(0,255,255,0.3);">
                <h6 class="text-info"><i class="fa-solid fa-code-compare"></i> Compare Mode: ${term}</h6>
                <p class="small mb-0 text-muted">${termData[term].comp}</p>
            </div>
        `;
        box.style.opacity = '1';
    }, 300);
}

function checkAns(btn, isCorrect) {
    document.querySelectorAll('.quiz-btn').forEach(b => b.disabled = true);
    if(isCorrect) {
        btn.classList.add('correct');
        document.getElementById('quiz-feedback').innerHTML = '<span class="text-success"><i class="fa-solid fa-circle-check"></i> AI Verified: Correct! Once loaded on the ship under FOB, the risk transfers to the buyer.</span>';
    } else {
        btn.classList.add('wrong');
        document.getElementById('quiz-feedback').innerHTML = '<span class="text-danger"><i class="fa-solid fa-circle-xmark"></i> Incorrect. The correct answer is B. Risk transfers to the buyer once loaded.</span>';
    }
}
</script>

<?php include('../includes/footer.php'); ?>
