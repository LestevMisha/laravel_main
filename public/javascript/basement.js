document.addEventListener("DOMContentLoaded", function () {

    // GLOBAL
    let scene, camera, renderer, controls, gltfObject, clock;
    const sceneElement = document.getElementById("scene");
    // init
    function init() {
        scene = new THREE.Scene();
        camera = new THREE.PerspectiveCamera(75, sceneElement.getBoundingClientRect().width / sceneElement.getBoundingClientRect().height, 0.1, 1000);
        renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        controls = new THREE.OrbitControls(camera, renderer.domElement);
        clock = new THREE.Clock();
        // renderer settings
        renderer.setClearColor(0x000000, 0);
        renderer.setSize(sceneElement.getBoundingClientRect().width, sceneElement.getBoundingClientRect().height);
        // camera settings
        camera.position.set(1, 0, 0);

        // controls orbit settings
        controls.minDistance = 5;
        // controls.enableZoom = false; // Disable zooming
        // controls.minPolarAngle = Math.PI / 2;
        // controls.maxPolarAngle = Math.PI / 2;
        controls.update();

        // elements
        const axesHelper = new THREE.AxesHelper(5);
        scene.add(axesHelper);

        var pivot = new THREE.Group();
        const loader = new THREE.GLTFLoader().setPath('3D/basement/');
        loader.load('scene.gltf', function (gltf) {
            gltfObject = gltf.scene;
            gltf.scene.scale.set(.1, .1, .1);
            // gltf.scene.wireframe = true;
            // gltfObject.position.z = -4;
            pivot.position.x = -3;
            pivot.position.y = -1;

            scene.add(pivot);
            pivot.add(gltfObject);
        });
        // const light = new THREE.AmbientLight(0xffffff); // soft white light
        // scene.add(light);
        // const directionalLight = new THREE.DirectionalLight(0xffffff, 100);
        // scene.add(directionalLight);
        // const directionalLight2 = new THREE.DirectionalLight(0x0d6efd, 100);
        // scene.add(directionalLight2);

        const pointLight = new THREE.PointLight( 0x0d6efd, 1, 100 );
        pointLight.position.set( 10, 10, 10 );
        scene.add( pointLight );
        
        // const sphereSize = 1;
        // const pointLightHelper = new THREE.PointLightHelper( pointLight, sphereSize );
        // scene.add( pointLightHelper );

        // animate
        function animate(time) {

            // Rotate the loaded object
            if (gltfObject) {
                const time = clock.getElapsedTime();

                // gltfObject.position.y = Math.cos(time) * 0.1;
                // pivot.rotateY(Math.cos(time) * (-0.001));
                // // Apply floating effect using sine function
                // const floatingOffset = (Math.sin(time)**5) * 0.001; // Adjust the amplitude (0.1 in this case)
                // gltfObject.position.y = floatingOffset; // Apply the offset to the y position
            }

            renderer.render(scene, camera);
            // composer.render();
        }

        // finish up
        // const composer = new THREE.EffectComposer(renderer);

        // const renderPass = new THREE.RenderPass(scene, camera);
        // composer.addPass(renderPass);

        // const glitchPass = new THREE.FilmPass(
        //     0.35, // noise intensity

        //     0.6, // scanline intensity

        //     2048, // scanline count

        //     false, // grayscale
        // );
        // composer.addPass(glitchPass);

        sceneElement.appendChild(renderer.domElement);
        renderer.setAnimationLoop(animate);
    }

    init();

    function onWindowResize() {
        camera.aspect = sceneElement.getBoundingClientRect().width / sceneElement.getBoundingClientRect().height;
        camera.updateProjectionMatrix();
        renderer.setSize(sceneElement.getBoundingClientRect().width, sceneElement.getBoundingClientRect().height);
    }
    window.addEventListener("resize", onWindowResize, false);

});