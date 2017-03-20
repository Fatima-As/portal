class KS_Modal {

  constructor(selectorName, modalContentsSelector, clickRegionElement=null) {
    
		this.self = document.querySelector(selectorName);
    this.modalContents = document.querySelector(modalContentsSelector);
    this.clickRegionElement = document.querySelector(clickRegionElement);
    this.isOpen = false;
    this.openDelay = 500;
    this.openDelayTimer = null;
    
    // Initialize modal
    this._init();
  }
  
  _init() {
    // Create node ID to hold the markup for this modal instance
    var modalNodeInstance = document.createElement('div');
		modalNodeInstance.id = 'ks-modal-instance-' + Math.floor(Math.random()*100000);
    
    // Create modal container element
    this.modalEle = document.createElement('div');
		this.modalEle.classList.add('ks-modal');
    
    // Create modal inner container
    var modalInnerEle = document.createElement('div');
    modalInnerEle.classList.add('ks-modal-inner');
    
    // Clone modal contents into inner modal container
    var modalContents = this.modalContents.cloneNode(true);
    modalInnerEle.appendChild(modalContents);
    
    // Add modal node instance to the DOM
    document.body.appendChild(modalNodeInstance);
    
    // Add inner container as a child to the modal element
    this.modalEle.appendChild(modalInnerEle);
    
    // Add modal element to the instance container
    modalNodeInstance.appendChild(this.modalEle);
    
    // Get click region element
    var clickRegionElement;
    if(this.clickRegionElement === null) {
			clickRegionElement = this.self;      
    }
    else {
      clickRegionElement = this.clickRegionElement;
    }

    // Add event listeners for modal
    clickRegionElement.addEventListener('click', () => {
      
      if(this.isOpen) {
				this.close();
      }
      else {
        this.open();
      }
    });
  }
  
  open() {
    
    // Only open the modal if delay timer expired
    if(this.openDelayTimer === null) {
      this.isOpen = true;
      
      this.self.classList.add('is-open');
      this.modalEle.classList.add('open');

      if(this.clickRegionElement !== null) {
        this.clickRegionElement.classList.add('active');
      }
      
      this.openDelayTimer = setTimeout( () => {
        clearTimeout(this.openDelayTimer);
        this.openDelayTimer = null;
      }, this.openDelay);
    }
  }
  
  close() {
    
    // Only close the modal if delay timer expired
    if(this.openDelayTimer === null) {
      this.isOpen = false;

      this.self.classList.remove('is-open');
      this.modalEle.classList.remove('open');

      if(this.clickRegionElement !== null) {
        this.clickRegionElement.classList.remove('active');
        this.clickRegionElement.classList.add('closing');
      }
      
      this.openDelayTimer = setTimeout( () => {
        if(this.clickRegionElement !== null) {
	        this.clickRegionElement.classList.remove('closing');
        }
        clearTimeout(this.openDelayTimer);
        this.openDelayTimer = null;
      }, this.openDelay);
    }
  }
}

// Create modal instance...
var menuModal = new KS_Modal('#burger-menu', '#site-menu-contents', '#burger-click-region');