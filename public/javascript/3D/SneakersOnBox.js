document.addEventListener("DOMContentLoaded", function () {

    // GLOBAL
    let scene, camera, renderer, controls, gltfObject, clock, pivot, current_step;
    const anchorElement = document.getElementById("sneakers-anchor");

    function gltf_init(path, file_name, pivot, size = 10.0, y = -1, step = 1) {
        const loader = new THREE.GLTFLoader().setPath(path);
        loader.load(file_name, function (gltf) {
            gltfObject = gltf.scene;
            gltf.scene.scale.set(size, size, size);
            scene.position.y = y;
            scene.add(pivot);
            pivot.add(gltfObject);
        });
        current_step = step;
    }

    // init
    function init() {
        scene = new THREE.Scene();
        camera = new THREE.PerspectiveCamera(75, anchorElement.getBoundingClientRect().width / anchorElement.getBoundingClientRect().height, 0.1, 1000);
        renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        controls = new THREE.OrbitControls(camera, renderer.domElement);
        clock = new THREE.Clock();
        // renderer settings
        renderer.setClearColor(0x000000, 0);
        renderer.setSize(anchorElement.getBoundingClientRect().width, anchorElement.getBoundingClientRect().height);
        // camera settings
        camera.position.set(1, 0, 0);

        // controls orbit settings
        controls.minDistance = 3.5;
        controls.enableZoom = false; // Disable zooming
        controls.minPolarAngle = Math.PI / 2;
        controls.maxPolarAngle = Math.PI / 2;
        controls.update();

        // elements
        pivot = new THREE.Group();
        gltf_init('3D/SneakersOnBox/', 'SneakersOnBox-scene.gltf', pivot);

        // helpers
        // const axesHelper = new THREE.AxesHelper(5);
        // scene.add(axesHelper);
        const spotLight = new THREE.SpotLight(0xffffff, 2, 0, .5);
        spotLight.position.set(5, 0, 0);
        scene.add(spotLight);
        const spotLight1 = new THREE.SpotLight(0xffffff, 4, 0, 1.5);
        spotLight1.position.set(-5, 3, 0);
        scene.add(spotLight1);
        const spotLight2 = new THREE.SpotLight(0xffffff, 2.5, 0, .5);
        spotLight2.position.set(0, 3, -5);
        scene.add(spotLight2);
        const spotLight3 = new THREE.SpotLight(0xffffff, 3, 0, .5);
        spotLight3.position.set(0, 3, 5);
        scene.add(spotLight3);

        // animate
        function animate() {
            // Rotate the loaded object
            if (gltfObject) {
                const time = clock.getElapsedTime();
                gltfObject.position.y = Math.cos(time) * 0.1;
                pivot.rotateY(-0.005);
            }

            renderer.render(scene, camera);
            // composer.render();
        }


        // finish up
        // const composer = new THREE.EffectComposer(renderer);

        // const renderPass = new THREE.RenderPass(scene, camera);
        // composer.addPass(renderPass);

        // const glitchPass = new THREE.GlitchPass();
        // composer.addPass(glitchPass);

        anchorElement.appendChild(renderer.domElement);
        renderer.setAnimationLoop(animate);
    }

    init();

    function removeObject3D(object3D) {
        if (object3D.parent !== null) object3D.parent.remove(object3D);
    }

    function onWindowResize() {
        camera.aspect = anchorElement.getBoundingClientRect().width / anchorElement.getBoundingClientRect().height;
        camera.updateProjectionMatrix();
        renderer.setSize(anchorElement.getBoundingClientRect().width, anchorElement.getBoundingClientRect().height);
    }
    window.addEventListener("resize", onWindowResize, false);

    const steps = document.querySelectorAll(".b-circle-wrapper");
    steps.forEach(step => {
        const step_info = step.parentElement.querySelector(".hook");

        step.addEventListener("mouseenter", function () {
            var step_num = step.getAttribute("data-step");
            console.log("hovered", step_info, step_num);
            step_info.classList.add("active");

            if (step_num == 1) {
                if (current_step === 1) return;
                removeObject3D(gltfObject);
                gltf_init('3D/SneakersOnBox/', 'SneakersOnBox-scene.gltf', pivot, 10.0, -1, 1);
            } else if (step_num == 2) {
                if (current_step === 2) return;
                removeObject3D(gltfObject);
                gltf_init('3D/box_package/', 'scene.gltf', pivot, 5.0, 0, 2);
            } else if (step_num == 3) {
                if (current_step === 3) return;
                removeObject3D(gltfObject);
                gltf_init('3D/cartoon_car/', 'scene.gltf', pivot, .3, -1, 3);
            } else if (step_num == 4) {
                if (current_step === 4) return;
                removeObject3D(gltfObject);
                gltf_init('3D/floating-camera/', 'scene.gltf', pivot, .75, -1, 4);
            } else if (step_num == 5) {
                if (current_step === 5) return;
                removeObject3D(gltfObject);
                gltf_init('3D/gold_bar_low_poly/', 'scene.gltf', pivot, .5, -0.5, 5);
            }
        });

        step.addEventListener("mouseleave", function () {
            step_info.classList.remove("active");

        });
    });
});